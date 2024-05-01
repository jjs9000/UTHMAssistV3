<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified', 'redirect.if.admin'])->group(function () {
    Route::get('/message', [MessageController::class, 'index'])->name('message.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'admin'])->group(function () {
    // Display Admin Dashboard
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard'); 
});


require __DIR__.'/auth.php';
