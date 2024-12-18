<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_status', function (Blueprint $table) {
            $table->id('status_id')->autoIncrement();
            $table->unsignedBigInteger('order_id');
            $table->string('tracking_number', 20);
            $table->enum('status_code', ['PESANAN_DITERIMA',  'POLA_DIBUAT', 'PROSES_POTONG', 'PROSES_JAHIT', 'QUALITY_CONTROL', 'SELESAI', 'SIAP_DIAMBIL']);
            $table->dateTime('status_date')->useCurrent();

            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('tracking_number')->references('tracking_number')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
