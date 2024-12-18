<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function laporan()
    {
        return view('laporan.index');
    }

    public function cetakLaporan(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));
        $orders = Order::whereBetween('order_date', [$startDate, $endDate])->get();

        $pdf = Pdf::loadView('laporan.cetak', compact('orders', 'startDate', 'endDate'));
        return $pdf->download('laporan_' . $startDate->format('Ymd') . '_to_' . $endDate->format('Ymd') . '.pdf');
    }
}
