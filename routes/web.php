<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canRegister' => Features::enabled(Features::registration()),
//     ]);
// })->name('home');
Route::get('/',HomeController::class);

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/authRoute.php';
require __DIR__.'/adminRoute.php';
