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

Route::get('/', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard.index');
    })->name('admin.dashboard.index');

    Route::get('/admin/barang', [AdminBarangController::class, 'index'])->name('admin.barang.index');
    Route::get('/admin/barang/create', [AdminBarangController::class, 'create'])->name('admin.barang.create');
    Route::get('/admin/barang/{id}/edit', [AdminBarangController::class, 'edit'])->name('admin.barang.edit');
    Route::post('/admin/barang/store', [AdminBarangController::class, 'store'])->name('admin.barang.store');
    Route::put('/admin/barang/{id}/update', [AdminBarangController::class, 'update'])->name('admin.barang.update');
    Route::delete('/admin/barang/{id}/destroy', [AdminBarangController::class, 'destroy'])->name('admin.barang.destroy');


    Route::get('/admin/barang/search', [AdminBarangController::class, 'search']);
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
    Route::put('/karyawan/barang/{id}/update', [KaryawanBarangController::class, 'update'])->name('karyawan.barang.update');
    Route::get('/karyawan/barang/{id}/edit', [KaryawanBarangController::class, 'edit'])->name('karyawan.barang.edit');
    Route::delete('/karyawan/barang/{id}/destroy', [KaryawanBarangController::class, 'destroy'])->name('karyawan.barang.destroy');

    Route::get('/karyawan/barang/search', [KaryawanBarangController::class, 'search']);
});
