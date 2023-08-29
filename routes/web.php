<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Karyawan\KaryawanBarangController;
use App\Http\Controllers\Admin\AdminBarangController;

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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard.index');
    })->name('admin.dashboard.index');

    Route::get('/admin/barang', [AdminBarangController::class, 'index'])->name('admin.barang.index');
});

Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/karyawan', function () {
        return view('karyawan.dashboard.index');
    })->name('karyawan.dashboard.index');

    Route::get('/pos', function () {
        return view('pos.index');
    })->name('pos.index');


    Route::get('/karyawan/barang', [KaryawanBarangController::class, 'index'])->name('karyawan.barang.index');
    Route::get('/karyawan/barang/create', [KaryawanBarangController::class, 'create'])->name('karyawan.barang.create');
    Route::post('/karyawan/barang/store', [KaryawanBarangController::class, 'store'])->name('karyawan.barang.store');
    Route::get('/karyawan/barang/{id}/update', [KaryawanBarangController::class, 'update'])->name('karyawan.barang.update');
});
