<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Memanggil metode statis dari model Order
        $totalOrders = Order::totalOrders();
        $totalProses = Order::totalProses();
        $totalSelesai = Order::totalSelesai();
        $totalPendapatanBulanIni = Order::totalPendapatanBulanIni();
        $revenueData = Order::revenueLastFourMonths();

        return view('home', compact('totalOrders', 'totalProses', 'totalSelesai', 'totalPendapatanBulanIni', 'revenueData'));
    }
}
