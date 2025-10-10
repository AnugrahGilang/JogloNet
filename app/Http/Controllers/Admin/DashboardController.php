<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\ProdukWifi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalTagihan   = Tagihan::count();
        $lunas          = Tagihan::where('status', 'Lunas')->count();
        $belumLunas     = Tagihan::where('status', 'Belum Lunas')->count();

        // Ambil semua produk
        $produk = ProdukWifi::orderBy('kecepatan')->get();

        // Pelanggan terbaru
        $pelangganBaru = Pelanggan::latest()->take(5)->get();

        // Bulan dan tahun sekarang
        $now   = now();
        $year  = $now->year;
        $month = $now->month;

        // Ambil tagihan bulan ini dengan produk
        $tagihanBulanIni = Tagihan::with('produk')
            ->whereYear('tanggal_terbit', $year)
            ->whereMonth('tanggal_terbit', $month)
            ->get();

        // Hitung total uang LUNAS & BELUM LUNAS (berdasarkan harga produk)
        $lunasTotal = 0;
        $belumLunasTotal = 0;

        foreach ($tagihanBulanIni as $t) {
            if ($t->produk) {
                if (strtolower($t->status) === 'lunas') {
                    $lunasTotal += $t->produk->harga;
                } else {
                    $belumLunasTotal += $t->produk->harga;
                }
            }
        }

        // --- Data untuk chart Lunas/Belum Lunas per bulan ---
        $bulanArr = collect(range(1, 12))->map(function ($i) {
            return Carbon::create()->month($i)->format('M');
        });

        $lunasBulanan = [];
        $belumLunasBulanan = [];

        foreach (range(1, 12) as $i) {
            $lunasBulanan[] = Tagihan::with('produk')
                ->where('status', 'Lunas')
                ->whereYear('tanggal_terbit', $year)
                ->whereMonth('tanggal_terbit', $i)
                ->get()
                ->sum(function ($t) {
                    return $t->produk ? $t->produk->harga : 0;
                });

            $belumLunasBulanan[] = Tagihan::with('produk')
                ->where('status', 'Belum Lunas')
                ->whereYear('tanggal_terbit', $year)
                ->whereMonth('tanggal_terbit', $i)
                ->get()
                ->sum(function ($t) {
                    return $t->produk ? $t->produk->harga : 0;
                });
        }

        // --- Chart Transaksi Bulanan ---
        $transaksiBulanan = Tagihan::with('produk')
            ->whereYear('tanggal_terbit', $year)
            ->get();

        $transaksiData = [];
        foreach ($transaksiBulanan as $t) {
            if ($t->produk) {
                $bulanKey = date('M', strtotime($t->tanggal_terbit));
                if (!isset($transaksiData[$bulanKey])) {
                    $transaksiData[$bulanKey] = 0;
                }
                $transaksiData[$bulanKey] += $t->produk->harga;
            }
        }

        $bulan = array_keys($transaksiData);
        $transaksi = array_values($transaksiData);

        // --- Chart Belum Lunas Bulanan ---
        $belumLunasData = [];
        foreach ($transaksiBulanan as $t) {
            if ($t->produk && strtolower($t->status) === 'belum lunas') {
                $bulanKey = date('M', strtotime($t->tanggal_terbit));
                if (!isset($belumLunasData[$bulanKey])) {
                    $belumLunasData[$bulanKey] = 0;
                }
                $belumLunasData[$bulanKey] += $t->produk->harga;
            }
        }

        $bulanBelumLunas = array_keys($belumLunasData);
        $jumlahBelumLunas = array_values($belumLunasData);

        return view('pages.admin.dashboard', compact(
            'totalPelanggan',
            'totalTagihan',
            'lunas',
            'belumLunas',
            'pelangganBaru',
            'produk',
            'lunasTotal',
            'belumLunasTotal',
            'bulanArr',
            'lunasBulanan',
            'belumLunasBulanan',
            'bulan',
            'transaksi',
            'bulanBelumLunas',
            'jumlahBelumLunas'
        ));
    }
}
