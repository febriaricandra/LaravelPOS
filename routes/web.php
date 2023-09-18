<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Karyawan\KaryawanBarangController;
use App\Http\Controllers\Admin\AdminBarangController;
use App\Http\Controllers\Karyawan\POSController;

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

Route::get('/', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::get('/admin/barang', [AdminBarangController::class, 'index'])->name('admin.barang.index');
    Route::get('/admin/barang/create', [AdminBarangController::class, 'create'])->name('admin.barang.create');
    Route::get('/admin/barang/{id}/edit', [AdminBarangController::class, 'edit'])->name('admin.barang.edit');
    Route::post('/admin/barang/store', [AdminBarangController::class, 'store'])->name('admin.barang.store');
    Route::put('/admin/barang/{id}/update', [AdminBarangController::class, 'update'])->name('admin.barang.update');
    Route::delete('/admin/barang/{id}/destroy', [AdminBarangController::class, 'destroy'])->name('admin.barang.destroy');
    Route::get('/admin/barang/search', [AdminBarangController::class, 'search']);

    //order admin
    Route::get('/admin/order', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.order.index');
    Route::get('/admin/order/{id}/show', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.order.show');

    //karyawan
    Route::get('/admin/karyawan', [App\Http\Controllers\Admin\KaryawanController::class, 'index'])->name('admin.karyawan.index');
    Route::get('/admin/karyawan/create', [App\Http\Controllers\Admin\KaryawanController::class, 'create'])->name('admin.karyawan.create');
    Route::post('/admin/karyawan/store', [App\Http\Controllers\Admin\KaryawanController::class, 'store'])->name('admin.karyawan.store');
    Route::delete('/admin/karyawan/{id}/destroy', [App\Http\Controllers\Admin\KaryawanController::class, 'destroy'])->name('admin.karyawan.destroy');

    //utang
    Route::get('/admin/utang', [App\Http\Controllers\Admin\UtangController::class, 'index'])->name('admin.utang.index');
    Route::get('/admin/utang/{id}/show', [App\Http\Controllers\Admin\UtangController::class, 'show'])->name('admin.utang.show');
    Route::get('/admin/utang/{id}/edit', [App\Http\Controllers\Admin\UtangController::class, 'edit'])->name('admin.utang.edit');
    Route::put('/admin/utang/{id}/update', [App\Http\Controllers\Admin\UtangController::class, 'update'])->name('admin.utang.update');
});




Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/karyawan', [App\Http\Controllers\Karyawan\DashboardController::class, 'index'])->name('karyawan.dashboard.index');


    Route::get('/karyawan/barang', [KaryawanBarangController::class, 'index'])->name('karyawan.barang.index');
    Route::get('/karyawan/barang/create', [KaryawanBarangController::class, 'create'])->name('karyawan.barang.create');
    Route::post('/karyawan/barang/store', [KaryawanBarangController::class, 'store'])->name('karyawan.barang.store');
    Route::put('/karyawan/barang/{id}/update', [KaryawanBarangController::class, 'update'])->name('karyawan.barang.update');
    Route::get('/karyawan/barang/{id}/edit', [KaryawanBarangController::class, 'edit'])->name('karyawan.barang.edit');
    Route::delete('/karyawan/barang/{id}/destroy', [KaryawanBarangController::class, 'destroy'])->name('karyawan.barang.destroy');
    Route::get('/karyawan/barang/search', [KaryawanBarangController::class, 'search']);

    //pos
    Route::get('/karyawan/pos', [POSController::class, 'index'])->name('karyawan.pos.index');
    Route::get('/karyawan/pos/search', [POSController::class, 'search']);
    Route::post('/karyawan/pos/checkout', [POSController::class, 'checkout'])->name('karyawan.pos.checkout');

    //order karyawan
    Route::get('/karyawan/order', [App\Http\Controllers\Karyawan\OrderController::class, 'index'])->name('karyawan.order.index');
    Route::get('/karyawan/order/{id}/show', [App\Http\Controllers\Karyawan\OrderController::class, 'show'])->name('karyawan.order.show');

    //utang
    Route::get('/karyawan/utang', [App\Http\Controllers\Karyawan\UtangController::class, 'index'])->name('karyawan.utang.index');
    Route::get('/karyawan/utang/{id}/show', [App\Http\Controllers\Karyawan\UtangController::class, 'show'])->name('karyawan.utang.show');
    Route::get('/karyawan/utang/{id}/edit', [App\Http\Controllers\Karyawan\UtangController::class, 'edit'])->name('karyawan.utang.edit');
    Route::put('/karyawan/utang/{id}/update', [App\Http\Controllers\Karyawan\UtangController::class, 'update'])->name('karyawan.utang.update');
});
