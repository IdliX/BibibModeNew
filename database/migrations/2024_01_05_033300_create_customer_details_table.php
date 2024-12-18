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
        Schema::create('customer_details', function (Blueprint $table) {
            $table->id('customer_detail_id');
            $table->foreignId('order_id')->constrained('orders', 'order_id')->onDelete('cascade');
            $table->string('nama');
            $table->decimal('lingkar_dada', 8, 2)->nullable();
            $table->decimal('lingkar_pinggang', 8, 2)->nullable();
            $table->decimal('lingkar_pinggul', 8, 2)->nullable();
            $table->decimal('panjang_lengan', 8, 2)->nullable();
            $table->decimal('panjang_badan', 8, 2)->nullable();
            $table->decimal('lebar_bahu', 8, 2)->nullable();
            $table->decimal('harga', 10, 2);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_details');
    }
};
