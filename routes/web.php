<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleServiceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('vehicles', VehicleController::class);
    Route::resource('vehicle-service', VehicleServiceController::class);

    Route::resource('locations', LocationController::class);

    Route::get('reservations/export', [ReservationController::class, 'export'])->name('reservations.export');
    Route::resource('reservations', ReservationController::class);
});


require __DIR__ . '/auth.php';
