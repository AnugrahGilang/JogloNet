<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Pelanggan;
use App\Models\ProdukWifi;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::with('pelanggan', 'produk')->orderBy('tanggal_terbit', 'desc')->get();
        $pelanggan = Pelanggan::orderBy('nama_pelanggan')->get();
        $produk = ProdukWifi::orderBy('kecepatan')->get();
        return view('pages.admin.tagihan.index', compact('tagihan', 'pelanggan', 'produk'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $produk = ProdukWifi::all();
        return view('pages.admin.tagihan.create', compact('pelanggan', 'produk'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'pelanggan_id' => 'required|exists:pelanggan,id',
    //         'produk_id' => 'required|exists:produk_wifi,id',
    //         'periode' => 'required|string|max:20',
    //         'jumlah_tagihan' => 'required|numeric',
    //         'status' => 'required|in:Belum Lunas,Lunas,Jatuh Tempo',
    //         'tanggal_terbit' => 'required|date',
    //         'tanggal_jatuh_tempo' => 'required|date',
    //     ]);

    //     $produk = \App\Models\ProdukWifi::findOrFail($request->produk_id);
    //     Tagihan::create($request->all());
    //     return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil ditambahkan');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'produk_id' => 'required|exists:produk_wifi,id',
            'periode' => 'required|string|max:20',
            'status' => 'required|in:Belum Lunas,Lunas,Jatuh Tempo',
            'tanggal_terbit' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date',
        ]);

        $produk = ProdukWifi::findOrFail($request->produk_id);

        Tagihan::create([
            'pelanggan_id' => $request->pelanggan_id,
            'produk_id' => $produk->id,
            'periode' => $request->periode,
            'jumlah_tagihan' => $produk->harga,
            'status' => $request->status,
            'tanggal_terbit' => $request->tanggal_terbit,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
        ]);

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil ditambahkan');
    }


    public function edit($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        $pelanggan = Pelanggan::all();
        return view('pages.admin.tagihan.edit', compact('tagihan', 'pelanggan'));
    }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'pelanggan_id' => 'required|exists:pelanggan,id',
    //         'produk_id' => 'required|exists:produk_wifi,id',
    //         'periode' => 'required|string|max:20',
    //         'status' => 'required|in:Belum Lunas,Lunas,Jatuh Tempo',
    //         'tanggal_terbit' => 'required|date',
    //         'tanggal_jatuh_tempo' => 'required|date',
    //     ]);

    //     $tagihan = Tagihan::findOrFail($id);
    //     $tagihan->update($request->all());

    //     return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil diperbarui');
    // }

    public function update(Request $request, $id)
{
    $request->validate([
        'pelanggan_id' => 'required',
        'produk_id' => 'required',
        'periode' => 'required',
        'status' => 'required',
        'tanggal_terbit' => 'required|date',
        'tanggal_jatuh_tempo' => 'required|date',
    ]);

    $produk = ProdukWifi::findOrFail($request->produk_id);

    $tagihan = Tagihan::findOrFail($id);
    $tagihan->update([
        'pelanggan_id' => $request->pelanggan_id,
        'produk_id' => $request->produk_id,
        'periode' => $request->periode,
        'jumlah_tagihan' => $produk->harga, // ✅ ambil langsung dari produk
        'status' => $request->status,
        'tanggal_terbit' => $request->tanggal_terbit,
        'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
    ]);

    return redirect()->route('tagihan.index')->with('success', 'Data tagihan berhasil diperbarui!');
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
