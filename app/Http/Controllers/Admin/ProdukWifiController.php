<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProdukWifi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukWifiController extends Controller
{
    public function index() {
        $produk = ProdukWifi::all();
        return view('pages.admin.produk.index', compact('produk'));
    }

    public function create() {
        return view('pages.admin.produk.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'kecepatan'  => 'required|integer',
            'harga'      => 'required|numeric',
            'deskripsi'  => 'nullable|string',
        ]);

        ProdukWifi::create($request->all());

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id) {
        $produk = ProdukWifi::findOrFail($id);
        return view('pages.admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'kecepatan'  => 'required|integer',
            'harga'      => 'required|numeric',
            'deskripsi'  => 'nullable|string',
        ]);

        $produk = ProdukWifi::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui');
    }


    public function destroy($id) {
        $produk = ProdukWifi::findOrFail($id);
        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
