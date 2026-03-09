<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan semua data transaksi
    public function index()
    {
        $transaksi = Transaksi::all();
        return view('transaksi.index', compact('transaksi'));
    }

    // Menampilkan form tambah transaksi
    public function create()
    {
        return view('transaksi.create');
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        Transaksi::create($request->all());
        return redirect('/transaksi');
    }

    // Menghapus data transaksi
    public function destroy($id)
    {
        Transaksi::destroy($id);
        return redirect('/transaksi');
    }
}