<?php

use App\Http\Controllers\AppearanceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicPelamarController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canRegister' => Features::enabled(Features::registration()),
//     ]);
// })->name('home');
Route::get('/', HomeController::class);
Route::get('/locations', [HomeController::class, 'locations'])->name('locations');
Route::get('/karir', [HomeController::class, 'careers'])->name('careers');
Route::get('/lamar', [PublicPelamarController::class, 'create'])->name('lamar');
Route::post('/lamar', [PublicPelamarController::class, 'store'])->name('lamar.store');
Route::post('/appearance', [AppearanceController::class, 'update'])->name('appearance.update');

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/authRoute.php';
require __DIR__.'/adminRoute.php';
