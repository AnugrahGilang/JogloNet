<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Pelanggan;

class TagihanController extends Controller
{
    public function index()
    {
        // ambil tagihan (dengan eager load pelanggan)
        $tagihan = Tagihan::with('pelanggan')->orderBy('tanggal_terbit', 'desc')->get();

        // ambil daftar pelanggan untuk dropdown di modal
        $pelanggan = Pelanggan::orderBy('nama_pelanggan')->get();

        return view('pages.admin.tagihan.index', compact('tagihan', 'pelanggan'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all(); // untuk dropdown pilih pelanggan
        return view('pages.admin.tagihan.create', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'periode' => 'required|string|max:20',
            'produk' => 'required|string|max:20',
            'jumlah_tagihan' => 'required|numeric',
            'status' => 'required|in:Belum Lunas,Lunas,Jatuh Tempo',
            'tanggal_terbit' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
        ]);

        Tagihan::create($request->all());
        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $pelanggan = Pelanggan::all();
        return view('pages.admin.tagihan.edit', compact('tagihan', 'pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'periode' => 'required|string|max:20',
            'produk' => 'required|string|max:20',
            'jumlah_tagihan' => 'required|numeric',
            'status' => 'required|in:Belum Lunas,Lunas,Jatuh Tempo',
            'tanggal_terbit' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
        ]);

        $tagihan = Tagihan::findOrFail($id);
        $tagihan->update($request->all());

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->delete();

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dihapus');
    }

    public function print($id)
{
    $tagihan = Tagihan::with('pelanggan')->findOrFail($id);

    return view('pages.admin.tagihan.print', compact('tagihan'));
}
}
