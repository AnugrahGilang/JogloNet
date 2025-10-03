<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ProdukWifi;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index() {
        $produk = ProdukWifi::all();
        return view('user.produk.index', compact('produk'));
    }

    public function pesan($id) {
        $produk = ProdukWifi::findOrFail($id);
        $pelangganId = auth('web')->user()->id;

        $tagihan = Tagihan::create([
            'pelanggan_id'      => $pelangganId,
            'produk_id'         => $produk->id,
            'status'            => 'Belum Lunas',
            'jumlah'            => $produk->harga,
            'periode'           => now()->format('Y-m'),
            'tanggal_tagihan'   => now(),
            'tanggal_jatuh_tempo' => now()->addMonth(), // opsional
        ]);

        return redirect()->route('payment.  ', $tagihan->id);
    }
}
