<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\StockController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/user-address-counts', [UserController::class, 'getUserAddressCounts'])->name('user.address.counts');
Route::get('/users-without-addresses', [UserController::class, 'getUsersWithoutAddresses'])->name('users.without.addresses');
Route::get('/duplicate-addresses', [UserController::class, 'getDuplicateAddresses'])->name('duplicate.addresses');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/import-stock', [StockController::class, 'import'])->name('stock.import');
    Route::get('/download-stock', [StockController::class, 'download'])->name('stock.download');
});



require __DIR__.'/auth.php';
