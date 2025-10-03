@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h3>Histori Tagihan</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Paket Wifi</th>
                <th>Bulan</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tagihan as $index => $item)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $item->produkWifi->nama_paket ?? '-' }}</td>
                <td>{{ $item->bulan }}</td>
                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                <td>
                    @if($item->status == 'lunas')
                        <span class="badge bg-success">Lunas</span>
                    @else
                        <span class="badge bg-danger">Belum Lunas</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada histori tagihan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
