<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pages.admin.pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pages.admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'required|string|max:100',
            'group' => 'required|string|max:15',
            'paket' => 'required|string|max:15',
            'tanggal_pemasangan' => 'required',
            'status' => 'required'
        ]);

        Pelanggan::create($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'pelanggan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pages.admin.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'email' => 'nullable|email|max:100',
            'group' => 'required|string|max:15',
            'paket' => 'required|string|max:15',
            'tanggal_pemasangan' => 'required',
            'status' => 'required'
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus');
    }
}
