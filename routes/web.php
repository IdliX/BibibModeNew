<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerDetailController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LaporanController;

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/tracking', function () {
    return view('landingpage.tracking');
});

Route::post('tracking/search', [LandingController::class, 'searchTracking'])->name('tracking.search'); // Handle form submission


// Authentication Routes
Auth::routes();

// Protect routes with 'auth' middleware
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    // Order Routes
    Route::resource('order', OrderController::class);

    // Order Status Routes
    Route::resource('orderStatus', OrderStatusController::class);

    Route::put('/order-status/{id}', [OrderStatusController::class, 'update'])->name('orderStatus.update');

    Route::get('/laporan', [LaporanController::class, 'laporan'])->name('laporan.index');

    Route::get('/laporan/cetak', [LaporanController::class, 'cetakLaporan'])->name('laporan.cetak');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');