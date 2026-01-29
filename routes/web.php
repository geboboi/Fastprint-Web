<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

Route::get('/', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/tambah', [ProdukController::class, 'create'])->name('produk.create');
Route::post('/produk/simpan', [ProdukController::class, 'store'])->name('produk.store');
Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
Route::put('/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
Route::delete('/produk/hapus/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');