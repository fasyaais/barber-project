<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\PelamarController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('pelamar', PelamarController::class);
    Route::resource('jobs', JobController::class);
    Route::resource('merchants', MerchantController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('services', ServiceController::class);
});
