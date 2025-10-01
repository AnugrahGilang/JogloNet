<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Tagihan;

class DashboardController extends Controller
{

    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $totalTagihan   = Tagihan::count();
        $lunas          = Tagihan::where('status', 'Lunas')->count();
        $belumLunas     = Tagihan::where('status', 'Belum Lunas')->count();

        // 5 pelanggan terbaru
        $pelangganBaru = Pelanggan::latest()->take(5)->get();

        // Bulan & tahun berjalan
        $now        = now();
        $year       = $now->year;
        $month      = $now->month;

        // Total nilai tagihan bulan ini berdasarkan status
        $lunasTotal = Tagihan::whereYear('tanggal_terbit', $year)
            ->whereMonth('tanggal_terbit', $month)
            ->where('status', 'Lunas')
            ->sum('jumlah_tagihan');

        $belumLunasTotal = Tagihan::whereYear('tanggal_terbit', $year)
            ->whereMonth('tanggal_terbit', $month)
            ->where('status', 'Belum Lunas')
            ->sum('jumlah_tagihan');

        // Transaksi bulanan (semua status) untuk chart kiri bawah
        $transaksiBulanan = Tagihan::selectRaw('
                MONTH(tanggal_terbit) AS bulan_num,
                DATE_FORMAT(tanggal_terbit, "%b") AS bulan_label,
                SUM(jumlah_tagihan) AS total
            ')
            ->whereYear('tanggal_terbit', $year)
            ->groupBy('bulan_num', 'bulan_label')
            ->orderBy('bulan_num')
            ->get();

        $bulan      = $transaksiBulanan->pluck('bulan_label');
        $transaksi  = $transaksiBulanan->pluck('total');

        // Belum lunas per bulan untuk chart kanan bawah
        $belumLunasBulanan = Tagihan::selectRaw('
                MONTH(tanggal_terbit) AS bulan_num,
                DATE_FORMAT(tanggal_terbit, "%b") AS bulan_label,
                SUM(jumlah_tagihan) AS total
            ')
            ->whereYear('tanggal_terbit', $year)
            ->where('status', 'Belum Lunas')
            ->groupBy('bulan_num', 'bulan_label')
            ->orderBy('bulan_num')
            ->get();

        $bulanBelumLunas   = $belumLunasBulanan->pluck('bulan_label');
        $jumlahBelumLunas  = $belumLunasBulanan->pluck('total');

        return view('pages.admin.dashboard', compact(
            'totalPelanggan',
            'totalTagihan',
            'lunas',
            'belumLunas',
            'pelangganBaru',
            'lunasTotal',
            'belumLunasTotal',
            'bulan',
            'transaksi',
            'bulanBelumLunas',
            'jumlahBelumLunas'
        ));
    }

}
