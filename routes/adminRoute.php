<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\RoleCheck;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function(){
    Route::get('/',[AdminController::class,'index'])->name('dashboard');
    Route::resource('applications',ApplicationController::class);
    Route::resource('features',FeatureController::class);
    Route::resource('jobs',JobController::class);
    Route::resource('merchants',MerchantController::class);
    Route::resource('positions',PositionController::class);
    Route::resource('users',UserController::class);
});
