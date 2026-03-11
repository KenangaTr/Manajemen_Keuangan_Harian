<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan semua data transaksi
    public function index()
    {
        $transaksi = Transaksi::orderBy('tanggal', 'desc')->get();
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
        $request->validate([
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:Pemasukan,Pengeluaran',
            'nominal'    => 'required|numeric|min:1',
            'keterangan' => 'required|string|max:255',
        ], [
            'tanggal.required'    => 'Tanggal wajib diisi.',
            'jenis.required'      => 'Jenis transaksi wajib dipilih.',
            'jenis.in'            => 'Jenis transaksi tidak valid.',
            'nominal.required'    => 'Nominal wajib diisi.',
            'nominal.numeric'     => 'Nominal harus berupa angka.',
            'nominal.min'         => 'Nominal harus lebih dari 0.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max'      => 'Keterangan maksimal 255 karakter.',
        ]);

        Transaksi::create($request->only(['tanggal', 'jenis', 'nominal', 'keterangan']));

        return redirect('/transaksi')->with('success', 'Transaksi berhasil ditambahkan! 🎉');
    }

    // Menampilkan form edit transaksi
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.edit', compact('transaksi'));
    }

    // Memperbarui data transaksi
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:Pemasukan,Pengeluaran',
            'nominal'    => 'required|numeric|min:1',
            'keterangan' => 'required|string|max:255',
        ], [
            'tanggal.required'    => 'Tanggal wajib diisi.',
            'jenis.required'      => 'Jenis transaksi wajib dipilih.',
            'jenis.in'            => 'Jenis transaksi tidak valid.',
            'nominal.required'    => 'Nominal wajib diisi.',
            'nominal.numeric'     => 'Nominal harus berupa angka.',
            'nominal.min'         => 'Nominal harus lebih dari 0.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max'      => 'Keterangan maksimal 255 karakter.',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($request->only(['tanggal', 'jenis', 'nominal', 'keterangan']));

        return redirect('/transaksi')->with('success', 'Transaksi berhasil diperbarui! ✅');
    }

    // Menghapus data transaksi
    public function destroy($id)
    {
        Transaksi::destroy($id);
        return redirect('/transaksi')->with('success', 'Transaksi berhasil dihapus! 🗑️');
    }
}