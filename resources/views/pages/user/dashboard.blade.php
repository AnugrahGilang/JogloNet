@extends('layouts.main')

@section('title', 'Pilih Paket WiFi')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Pilih Paket Wifi</h1>

    <div class="row">
        @forelse($produk as $item)
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-3"></h5>
                        <p class="mb-1 font-weight-bold">{{ $item->nama_paket }}</p>
                        <p class="text-primary h5 mb-3">
                            Rp {{ number_format($item->harga, 0, ',', '.') }} / bulan
                        </p>
                        <ul class="list-unstyled text-muted mb-4">
                            <li>Kecepatan Hingga {{ $item->kecepatan }} Mbps</li>
                            <li>Tanpa Batas Kuota</li>
                            <li>Gratis Instalasi</li>
                            <li>Dukungan Penuh 24/7</li>
                        </ul>
                        <a href="{{ route('user.produk.pesan', $item->id) }}"
                           class="btn btn-success btn-block">
                           Pesan
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada produk WiFi tersedia.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
