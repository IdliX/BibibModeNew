<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';
    protected $primaryKey = 'status_id';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'tracking_number',
        'status_code',
        'status_date'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
