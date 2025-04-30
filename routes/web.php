<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MasterCustomerController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login_form'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware('auth')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/show/{user}', [UserController::class, 'show'])->name('user.show');
    Route::delete('/user/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');

    Route::resource('master-customer', MasterCustomerController::class);
    Route::resource('item', ItemController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
