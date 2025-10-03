<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelanggan;

class UserProfileController extends Controller
{
    // Tampilkan informasi pelanggan
    public function index()
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan; // bisa null kalau belum ada

        return view('pages.user.profile.index', compact('user', 'pelanggan'));
    }

    // Form create
    public function create()
    {
        return view('user.profile.create');
    }

    // Simpan pelanggan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'paket' => 'nullable|string|max:100',
            'alamat' => 'required|string',
            'group' => 'nullable|string|max:100',
            'no_hp' => 'required|string|max:15',
            'tanggal_pemasangan' => 'nullable|date',
            'status' => 'nullable|string|max:50',
        ]);

        $user = Auth::user();

        Pelanggan::create([
            'user_id' => $user->id,
            'nama_pelanggan' => $request->nama_pelanggan, // ✅
            'paket' => $request->paket,
            'alamat' => $request->alamat,
            'group' => $request->group,
            'email' => $user->email, // email tetap ambil dari akun user
            'no_hp' => $request->no_hp,
            'tanggal_pemasangan' => $request->tanggal_pemasangan,
            'status' => $request->status ?? 'Aktif',
        ]);

        return redirect()->route('user.profile.index')->with('success', 'Data pelanggan berhasil dibuat');
    }


    // Form edit
    public function edit()
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan;

        return view('user.profile.edit', compact('pelanggan'));
    }

    // Update pelanggan
    public function update(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'paket' => 'nullable|string|max:100',
            'alamat' => 'required|string',
            'group' => 'nullable|string|max:100',
            'no_hp' => 'required|string|max:15',
            'tanggal_pemasangan' => 'nullable|date',
            'status' => 'nullable|string|max:50',
        ]);

        $user = Auth::user();
        $pelanggan = $user->pelanggan;

        $pelanggan->update([
            'nama_pelanggan' => $request->nama_pelanggan, // ✅
            'paket' => $request->paket,
            'alamat' => $request->alamat,
            'group' => $request->group,
            'no_hp' => $request->no_hp,
            'tanggal_pemasangan' => $request->tanggal_pemasangan,
            'status' => $request->status ?? 'Aktif',
        ]);

        return redirect()->route('user.profile.index')->with('success', 'Profil berhasil diperbarui');
    }

    // Hapus data pelanggan
    public function destroy()
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan;

        if ($pelanggan) {
            $pelanggan->delete();
        }

        return redirect()->route('pages.user.profile.index')->with('success', 'Data pelanggan berhasil dihapus');
    }
}
