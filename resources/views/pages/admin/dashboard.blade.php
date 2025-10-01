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
                        <canvas id="donutChart"></canvas>
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
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Donut Chart
    const donut = document.getElementById('donutChart');
    if (donut) {
        new Chart(donut, {
            type: 'doughnut',
            data: {
                labels: ['Lunas', 'Belum Lunas'],
                datasets: [{
                    data: [{{ $lunas }}, {{ $belumLunas }}],
                    backgroundColor: ['#28a745', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }

    // Transaksi Bulanan
    const trx = document.getElementById('transaksiChart');
    if (trx) {
        new Chart(trx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($bulan) !!},
                datasets: [{
                    label: 'Total',
                    data: {!! json_encode($transaksi) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    // Belum Lunas Bulanan
    const bl = document.getElementById('belumLunasChart');
    if (bl) {
        new Chart(bl, {
            type: 'bar',
            data: {
                labels: {!! json_encode($bulanBelumLunas) !!},
                datasets: [{
                    label: 'Total',
                    data: {!! json_encode($jumlahBelumLunas) !!},
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
