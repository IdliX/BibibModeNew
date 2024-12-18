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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id')->autoIncrement();
            $table->string('name', 100);
            $table->string('phone', 15);
            $table->string('email', 100);
            $table->text('address')->nullable();
            $table->string('tracking_number', 20)->unique();
            $table->date('order_date')->useCurrent();
            $table->date('pickup_schedule');
            $table->decimal('total_price', 10, 2)->nullable();
            $table->string('status', 50)->default('PESANAN_DITERIMA');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
