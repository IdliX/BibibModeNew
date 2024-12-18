<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\OrderStatus;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'email',
        'tracking_number',
        'order_date',
        'pickup_schedule',
        'total_price',
        'status'
    ];

    protected $dates = [
        'order_date',
        'pickup_schedule',
        'created_at',
        'updated_at'
    ];

    // Relasi ke CustomerDetail
    public function customerDetails()
    {
        return $this->hasMany(Customer_Detail::class, 'order_id', 'order_id');
    }

    public function orderStatuses()
    {
        return $this->hasMany(OrderStatus::class, 'order_id', 'order_id');
    }

    // Method untuk menghitung total order pada bulan dan tahun ini
    public static function totalOrders()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        return self::whereMonth('order_date', $currentMonth)
                ->whereYear('order_date', $currentYear)
                ->count();
    }

    // Method untuk menghitung total order dengan status 'Proses' pada bulan dan tahun ini
    public static function totalProses()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        return self::whereMonth('order_date', $currentMonth)
                ->whereYear('order_date', $currentYear)
                ->whereIn('status', ['POLA_DIBUAT', 'PROSES_POTONG', 'PROSES_JAHIT', 'QUALITY_CONTROL'])
                ->count();
    }

    // Method untuk menghitung total order dengan status 'Selesai' pada bulan dan tahun ini
    public static function totalSelesai()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        return self::whereMonth('order_date', $currentMonth)
                ->whereYear('order_date', $currentYear)
                ->whereIn('status', ['SELESAI', 'SIAP_DIAMBIL'])
                ->count();
    }

    // Method untuk menghitung total pendapatan pada bulan ini
    public static function totalPendapatanBulanIni()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        return self::whereMonth('order_date', $currentMonth)
                ->whereYear('order_date', $currentYear)
                ->sum('total_price');
    }

    public static function revenueLastFourMonths()
    {
        $revenues = [];
        for ($i = 3; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $revenues[$month->format('Y-m')] = self::whereMonth('order_date', $month->month)
                ->whereYear('order_date', $month->year)
                ->sum('total_price');
        }
        return $revenues;
    }

    protected $casts = [
        'order_date' => 'date',
    ];
}