<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

// Index – daftar semua transaksi
Route::get('/transaksi', [TransaksiController::class, 'index']);

// Create – form tambah transaksi
Route::get('/transaksi/create', [TransaksiController::class, 'create']);

// Store – simpan transaksi baru
Route::post('/transaksi', [TransaksiController::class, 'store']);

// Edit – form edit transaksi
Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit']);

// Update – simpan perubahan transaksi
Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);

// Destroy – hapus transaksi
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);

// Root redirect ke /transaksi
Route::get('/', function () {
    return redirect('/transaksi');
});
