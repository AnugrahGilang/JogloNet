<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Tagihan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body { font-size: 13px; }
        .invoice-box {
            max-width: 900px;
            margin: auto;
            padding: 20px;
        }
        .table th, .table td {
            padding: 6px;
            vertical-align: middle;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="invoice-box">
        <!-- Header -->
        <div class="d-flex justify-content-between mb-3">
            <div>
                <h4><b>Joglo.net</b></h4>
                <small>INTERNET PROVIDER</small>
            </div>
            <div class="text-end">
                <h5>Joglo.net</h5>
            </div>
        </div>

        <!-- Info -->
        <table class="table table-bordered">
            <tr>
                <td width="33%">
                    <b>Dari</b><br>
                    Joglo.net<br>
                    Jl. Raya<br>
                    Phone : 0812 WA : 0812<br>
                    Email :
                </td>
                <td width="33%">
                    <b>Kepada</b><br>
                    {{ $tagihan->pelanggan->nama_pelanggan }}<br>
                    {{ $tagihan->pelanggan->alamat ?? '' }}<br>
                    Phone : {{ $tagihan->pelanggan->no_hp }}<br>
                    Email :
                </td>
                <td width="34%">
                    <b>Tagihan</b><br>
                    No Tagihan : {{ $tagihan->id }}<br>
                    Tanggal : {{ $tagihan->tanggal_terbit }}<br>
                    Jatuh Tempo : {{ $tagihan->tanggal_jatuh_tempo }}<br>
                    {{ $tagihan->status }}
                </td>
            </tr>
        </table>

        <!-- Produk -->
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Produk</th>
                    <th>Keterangan</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $tagihan->produk }} - {{ $tagihan->periode }}</td>
                    <td>{{ $tagihan->produk }}</td>
                    <td>1</td>
                    <td>{{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="row">
            <!-- Rekening Pembayaran -->
            <div class="col-6">
                <p><b>Rekening Pembayaran</b></p>
                <p>
                    Joglo.net <br>
                    BANK BSI 1033702918 (A/N : Endra Tristyana)<br>
                    BRI 388501023931536 (A/N : Endra Tristyana)<br>
                    MANDIRI 1710013788073 (A/N : Endra Tristyana)<br>
                    DANA -085330748335<br>
                </p>
                <p><b>Catatan :</b></p>
                {{-- QRIS / QR CODE bisa ditempel di sini --}}
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ $tagihan->id }}" alt="QR Code">
            </div>

            <!-- Ringkasan -->
            <div class="col-6">
                <table class="table table-bordered">
                    <tr><td>Subtotal</td><td class="text-end">{{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</td></tr>
                    <tr><td>Discount</td><td class="text-end">0</td></tr>
                    <tr><td>Pajak</td><td class="text-end">0</td></tr>
                    <tr><td>Biaya Admin</td><td class="text-end">0</td></tr>
                    <tr><td>Kode Unik</td><td class="text-end">0</td></tr>
                    <tr><th>Total</th><th class="text-end">{{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</th></tr>
                </table>
            </div>
        </div>

        <!-- Riwayat Pembayaran -->
        <p><b>Pembayaran</b></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Pembayaran</th>
                    <th>Diterima</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="text-center">-</td>
                </tr>
            </tbody>
        </table>

        <p>Terimakasih</p>
    </div>
</body>
</html>
