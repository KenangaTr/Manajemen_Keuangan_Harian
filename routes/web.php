<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TransaksiController;

Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::get('/transaksi/create', [TransaksiController::class, 'create']);
Route::post('/transaksi', [TransaksiController::class, 'store']);
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);

Route::get('/', function () {
    return view('welcome');
});
