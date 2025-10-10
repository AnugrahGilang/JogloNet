@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <div class="row">
        <!-- Donut Chart -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Tagihan - {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                    </h3>
                </div>
                <div class="card-body d-flex align-items-center justify-content-between">
                    <!-- Chart Donut -->
                    <div style="flex:1; max-width:60%;">
                        <canvas id="statusChart"></canvas>
                    </div>

                    <!-- Tabel Ringkasan -->
                    <div style="flex:1; max-width:35%;">
                        <table class="table table-bordered mb-0">
                            <tr>
                                <td>Belum Lunas</td>
                                <td>Rp {{ number_format($belumLunasTotal, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Lunas</td>
                                <td>Rp {{ number_format($lunasTotal, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Pelanggan Terbaru -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Pelanggan Terbaru</div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pelangganBaru as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->nama_pelanggan }}</td>
                                    <td>{{ $p->alamat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-2">
                        <small>
                            Informasi Tagihan:
                            Lunas: {{ $lunas }} Pelanggan |
                            Belum Lunas: {{ $belumLunas }} Pelanggan
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Transaksi & Belum Lunas -->
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Transaksi Bulanan</div>
                <div class="card-body">
                    <canvas id="transaksiChart" style="height:250px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Belum Lunas</div>
                <div class="card-body">
                    <canvas id="belumLunasChart" style="height:250px;"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Chart Lunas vs Belum Lunas
    const ctx = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($bulanArr),
            datasets: [
                {
                    label: 'Lunas',
                    data: @json($lunasBulanan),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                },
                {
                    label: 'Belum Lunas',
                    data: @json($belumLunasBulanan),
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Statistik Tagihan per Bulan'
                }
            },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Chart Transaksi Bulanan
    const trx = document.getElementById('transaksiChart');
    if (trx) {
        new Chart(trx, {
            type: 'bar',
            data: {
                labels: @json($bulan),
                datasets: [{
                    label: 'Total Transaksi',
                    data: @json($transaksi),
                    backgroundColor: 'rgba(255, 159, 64, 0.5)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    // Chart Belum Lunas Bulanan
    const bl = document.getElementById('belumLunasChart');
    if (bl) {
        new Chart(bl, {
            type: 'bar',
            data: {
                labels: @json($bulanBelumLunas),
                datasets: [{
                    label: 'Total Belum Lunas',
                    data: @json($jumlahBelumLunas),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }
});
</script>
@endsection
