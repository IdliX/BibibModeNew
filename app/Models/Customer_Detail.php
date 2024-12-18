<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer_Detail extends Model
{
    protected $table = 'customer_details';
    protected $primaryKey = 'customer_detail_id';
    
    protected $fillable = [
        'order_id',
        'nama',
        'lingkar_dada',
        'lingkar_pinggang',
        'lingkar_pinggul',
        'panjang_lengan',
        'panjang_badan',
        'lebar_bahu',
        'harga',
        'catatan'
    ];


        // In Customer_Detail.php
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
