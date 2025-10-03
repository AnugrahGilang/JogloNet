@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h3>Detail Layanan Wifi Saat Ini</h3>
    @if($pelanggan && $pelanggan->produkWifi)
    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Nama Paket:</strong> {{ $pelanggan->produkWifi->nama_paket }}</p>
            <p><strong>Kecepatan:</strong> {{ $pelanggan->produkWifi->kecepatan }} Mbps</p>
            <p><strong>Harga:</strong> Rp {{ number_format($pelanggan->produkWifi->harga, 0, ',', '.') }}</p>
            <p><strong>Status:</strong>
                @if($pelanggan->status == 'aktif')
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Tidak Aktif</span>
                @endif
            </p>
        </div>
    </div>
    @else
    <div class="alert alert-warning mt-3">
        Belum ada layanan wifi yang aktif.
    </div>
    @endif
</div>
@endsection
