@extends('layouts.app')
@php
    use Carbon\Carbon;
@endphp
@section('content')
<div class="container-fluid">

    {{-- Filter Form --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <h3 class="mb-4">Laporan Pembayaran</h3>
            <form method="GET" class="d-flex flex-wrap">
                <select name="bulan" class="form-control mr-2 mb-2" style="max-width: 180px;">
                    <option value="">-- Pilih Bulan --</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                            {{ date("F", mktime(0, 0, 0, $i, 1)) }}
                        </option>
                    @endfor
                </select>

                <select name="tahun" class="form-control mr-2 mb-2" style="max-width: 150px;">
                    <option value="">-- Pilih Tahun --</option>
                    @for ($t = date('Y'); $t >= 2020; $t--)
                        <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
                            {{ $t }}
                        </option>
                    @endfor
                </select>

                <button type="submit" class="btn btn-primary mb-2">Filter</button>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Pelanggan</th>
                            <th>Periode</th>
                            <th>Jumlah</th>
                            <th>Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembayaran as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->pelanggan->nama_pelanggan ?? '-' }}</td>
                            <td>{{ $p->periode ?? '-' }}</td>
                            <td>Rp {{ number_format($p->produk->harga, 0, ',', '.') }}</td>
                            <td>{{ Carbon::parse($p->updated_at)->translatedFormat('d F Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
