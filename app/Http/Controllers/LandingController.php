<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    public function index()
    {   
        return view('landingpage.index');
    }

    public function searchTracking(Request $request)
    {   
        // Validasi input
        $request->validate([
            'tracking_number' => 'required|string|max:20',
        ]);

        $trackingNumber = $request->input('tracking_number');

        // Query data tracking dari tabel order_status
        $orderStatuses = OrderStatus::with('order') // Ambil data dari relasi orders
            ->where('tracking_number', $trackingNumber)
            ->get();

        if ($orderStatuses->isEmpty()) {
            return back()->with('error', 'No order found for this tracking code.');
        }

        return view('landingpage.tracking', compact('orderStatuses'));
    }
}
