<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer_Detail;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {  
        // Check if there's a search query
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
        }
    
        $data['orders'] = Order::with('customerDetails')->latest()->paginate(10);
        return view('order.list_order', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order.create_order');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate main order data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'address' => 'required|string',
            'phone' => 'required|string|max:15',
            'email' => 'required|email',
            'order_date' => 'required|date',
            'pickup_date' => 'required|date|after:order_date',
            'total_price' => 'required|numeric|min:0',
            'customerdetails' => 'required|array|min:1',
            'customerdetails.*.name' => 'required|string|max:100',
            'customerdetails.*.chest_circumference' => 'nullable|numeric|min:0',
            'customerdetails.*.waist_circumference' => 'nullable|numeric|min:0',
            'customerdetails.*.hip_circumference' => 'nullable|numeric|min:0',
            'customerdetails.*.sleeve_length' => 'nullable|numeric|min:0',
            'customerdetails.*.body_length' => 'nullable|numeric|min:0',
            'customerdetails.*.shoulder_width' => 'nullable|numeric|min:0',
            'customerdetails.*.price' => 'required|numeric|min:0',
            'customerdetails.*.notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Generate tracking number
            $trackingNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));

            // Create the order
            $order = Order::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'tracking_number' => $trackingNumber,
                'order_date' => $request->order_date,
                'pickup_schedule' => $request->pickup_date,
                'total_price' => $request->total_price,
                'status' => 'PESANAN_DITERIMA'
            ]);

            // Mengirim email ke customer dengan kode tracking
            Mail::to($request->email)->send(new OrderConfirmationMail($order, $trackingNumber));

            // Create customer details
            foreach ($request->customerdetails as $detail) {
                Customer_Detail::create([
                    'order_id' => $order->order_id,
                    'nama' => $detail['name'],
                    'lingkar_dada' => $detail['chest_circumference'],
                    'lingkar_pinggang' => $detail['waist_circumference'],
                    'lingkar_pinggul' => $detail['hip_circumference'],
                    'panjang_lengan' => $detail['sleeve_length'],
                    'panjang_badan' => $detail['body_length'],
                    'lebar_bahu' => $detail['shoulder_width'],
                    'harga' => $detail['price'],
                    'catatan' => $detail['notes']
                ]);
            }

            // Create initial order status
            OrderStatus::create([
                'order_id' => $order->order_id,
                'tracking_number' => $trackingNumber,
                'status_code' => 'PESANAN_DITERIMA',
                'status_date' => now()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order berhasil ditambahkan. Nomor tracking: ' . $trackingNumber,
                'redirect' => route('order.index')
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan order: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $order->order_date = Carbon::parse($order->order_date);
        $order->pickup_schedule  = Carbon::parse($order->pickup_schedule);
        return view('order.edit_order', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Debug untuk melihat data yang diterima
        \Log::info('Data diterima:', $request->all());

        
        // Validasi data utama dan detail pelanggan
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'address' => 'required|string',
            'phone' => 'required|string|max:15|regex:/^[0-9]{10,15}$/',
            'email' => 'required|email',
            'order_date' => 'required|date',
            'status' => 'required|string',
            'pickup_schedule' => 'required|date|after_or_equal:order_date',
            'total_price' => 'required|numeric|min:0',
            'customerdetails' => 'required|array|min:1',
            'customerdetails.*.name' => 'required|string|max:100',
            'customerdetails.*.chest_circumference' => 'nullable|numeric|min:0',
            'customerdetails.*.waist_circumference' => 'nullable|numeric|min:0',
            'customerdetails.*.hip_circumference' => 'nullable|numeric|min:0',
            'customerdetails.*.sleeve_length' => 'nullable|numeric|min:0',
            'customerdetails.*.body_length' => 'nullable|numeric|min:0',
            'customerdetails.*.shoulder_width' => 'nullable|numeric|min:0',
            'customerdetails.*.price' => 'required|numeric|min:0',
            'customerdetails.*.notes' => 'nullable|string'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            DB::beginTransaction();
            
            // Cari data order berdasarkan ID
            $order = Order::findOrFail($id);
            
            // Cek apakah status berubah
            $statusChanged = $order->status !== $request->status;

            // Perbarui data order
            $order->update([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
                'status' => $request->status,
                'phone' => $request->phone,
                'order_date' => $request->order_date,
                'pickup_schedule' => $request->pickup_schedule,
                'total_price' => $request->total_price
            ]);
            
            if ($statusChanged) {
                DB::table('order_status')->insert([
                    'order_id' => $order->order_id,
                    'tracking_number' => $order->tracking_number,
                    'status_code' => $request->status,
                    'status_date' => now(),
                ]);
            }

            // Ambil semua ID detail pelanggan yang dikirim
            $sentCustomerNames = collect($request->customerdetails)->pluck('name')->toArray();

            // Hapus detail pelanggan yang tidak ada di data yang dikirim
            Customer_Detail::where('order_id', $order->order_id)
                ->whereNotIn('nama', $sentCustomerNames)
                ->delete();

            // Perbarui atau buat data detail pelanggan baru
            foreach ($request->customerdetails as $detail) {
                Customer_Detail::updateOrCreate(
                    [
                        'order_id' => $order->order_id,
                        'nama' => $detail['name']
                    ],
                    [
                        'lingkar_dada' => $detail['chest_circumference'],
                        'lingkar_pinggang' => $detail['waist_circumference'],
                        'lingkar_pinggul' => $detail['hip_circumference'],
                        'panjang_lengan' => $detail['sleeve_length'],
                        'panjang_badan' => $detail['body_length'],
                        'lebar_bahu' => $detail['shoulder_width'],
                        'harga' => $detail['price'],
                        'catatan' => $detail['notes']
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order berhasil diperbarui.',
                'redirect' => route('order.index')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui order: ' . $e->getMessage()
            ], 500);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('order.index')->with('success', 'Order deleted successfully.');
    }
}
