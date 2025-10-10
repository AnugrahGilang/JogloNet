<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\ProdukWifi;

class LaporanController extends Controller
{
        // Laporan Tagihan
        public function tagihan(Request $request)
        {
            $produk = ProdukWifi::orderBy('kecepatan')->get();
            $query = Tagihan::with('pelanggan');

            // Filter bulan
            if ($request->filled('bulan')) {
                $query->whereMonth('tanggal_terbit', $request->bulan);
            }

            // Filter tahun
            if ($request->filled('tahun')) {
                $query->whereYear('tanggal_terbit', $request->tahun);
            }

            // Filter status (lunas/belum lunas)
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $tagihan = $query->get();

            return view('pages.admin.laporan.tagihan', compact('tagihan', 'produk'));
        }

        // Laporan Pembayaran
        public function pembayaran(Request $request)
        {
            $produk = ProdukWifi::orderBy('kecepatan')->get();
            $query = Tagihan::with('pelanggan')->where('status', 'lunas');

            // Filter bulan & tahun dari updated_at
            if ($request->filled('bulan')) {
                $query->whereMonth('updated_at', $request->bulan);
            }
            if ($request->filled('tahun')) {
                $query->whereYear('updated_at', $request->tahun);
            }

            $pembayaran = $query->get();

            return view('pages.admin.laporan.pembayaran', compact('pembayaran', 'produk'));
        }
}
