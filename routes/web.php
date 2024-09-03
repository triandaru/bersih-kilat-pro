<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController,
    LayananController as AdminLayananController,
    TransaksiController as AdminTransaksiController,
    UserController
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('login', [
//         "title" => "Login"
//     ]);
// });

Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'authenticationLogin'])->name('akses.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('checkAkses:admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::prefix('layanan')->name('layanan.')->group(function () {
        Route::get('/', [AdminLayananController::class, 'index'])->name('index');
        Route::get('/create', [AdminLayananController::class, 'create'])->name('create');
        Route::post('/create', [AdminLayananController::class, 'store'])->name('store');
        Route::get('{id_layanan}/edit', [AdminLayananController::class, 'edit'])->name('edit');
        Route::put('{id_layanan}', [AdminLayananController::class, 'update'])->name('update');
        Route::delete('{id_layanan}', [AdminLayananController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/', [AdminTransaksiController::class, 'index'])->name('index');
        route::get('/create', [AdminTransaksiController::class, 'create'])->name('create');
        route::post('/create', [AdminTransaksiController::class, 'store'])->name('store');
        Route::get('{id_transaksi}/edit', [AdminTransaksiController::class, 'edit'])->name('edit');
        Route::put('{id_transaksi}', [AdminTransaksiController::class, 'update'])->name('update');
        Route::delete('{id_transaksi}', [AdminTransaksiController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('manajemen_user')->name('manajemen_user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        route::get('/create', [UserController::class, 'create'])->name('create');
        route::post('/create', [UserController::class, 'store'])->name('store');
        Route::get('{id_user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('{id_user}', [UserController::class, 'update'])->name('update');
        Route::delete('{id_user}', [UserController::class, 'destroy'])->name('destroy');
    });
});
