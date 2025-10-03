<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProdukWifi;
use App\Models\Tagihan;
use App\Models\Pelanggan;

class DashboardController extends Controller
{
    public function index(){
        $produk = ProdukWifi::all();
        return view('pages.user.dashboard', compact('produk'));
    }

    public function tagihan()
    {
        $user = Auth::user();

        // Ambil pelanggan yang terkait dengan user login
        $pelanggan = Pelanggan::where('user_id', $user->id)->first();

        // Ambil semua tagihan dari pelanggan ini
        $tagihan = Tagihan::with('produkWifi')
            ->where('pelanggan_id', $pelanggan->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.user.tagihan', compact('tagihan'));
    }

    public function layanan()
    {
        $user = Auth::user();

        // Ambil pelanggan terkait user
        $pelanggan = Pelanggan::with('produkWifi')
            ->where('user_id', $user->id)
            ->first();

        return view('pages.user.layanan', compact('pelanggan'));
    }
}
