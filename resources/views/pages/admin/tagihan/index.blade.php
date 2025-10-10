@extends('layouts.app')
@php
    use Carbon\Carbon;
@endphp

@section('title', 'Data Tagihan')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Tagihan</h3>
            <div class="card-tools">
                <!-- Tombol buka modal -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#modalTambahTagihan">
                    <i class="fas fa-plus"></i> Tambah Tagihan
                </button>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Keterangan</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Jatuh Tempo</th>
                        <th>Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tagihan as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $t->pelanggan->nama_pelanggan }}</td>
                        <td>{{ $t->periode }}</td>
                        <td>{{ $t->produk->kecepatan ?? '-' }}</td>
                        <td>Rp {{ number_format($t->produk->harga, 0, ',', '.') }}</td>
                        <td>{{ $t->status }}</td>
                        <td>{{ Carbon::parse($t->tanggal_terbit)->translatedFormat('d F Y') }}</td>
                        <td>{{ Carbon::parse($t->tanggal_jatuh_tempo)->translatedFormat('d F Y') }}</td>
                        <td>
                            @php
                            $tanggalTempo = \Carbon\Carbon::parse($t->tanggal_jatuh_tempo)->translatedFormat('d F Y');
                            $tanggalBayar = \Carbon\Carbon::parse($t->tanggal_terbit)->translatedFormat('d F Y');
                            $nominal = 'Rp ' . number_format($t->jumlah_tagihan, 0, ',', '.');
                            $nama = $t->pelanggan->nama_pelanggan;

                            if ($t->status === 'Belum Lunas') {
                            $pesan =
                            "Joglo.net invoice telah diterbitkan%0A%0A".
                            "Yth. {$nama}%0AHotspot Joglo.Net%0A%0A".
                            "Mengingatkan Tagihan iuran internet Bulan {$t->periode} sebesar {$nominal}%0A".
                            "dan utk menghindari pengurangan kecepatan internet,%0A".
                            "lakukan pembayaran sebelum tanggal {$tanggalTempo}%0A%0A".
                            "Pembayaran dapat dilakukan melalui:%0A".
                            "1. ✓ Transfer Bank BSI%0A".
                            " Norek. 1033702918%0A".
                            " A/N : Endra Tristyana%0A%0A".
                            " ✓ Transfer Bank BRI%0A".
                            " Norek. 388501023931536%0A".
                            " A/N : Endra Tristyana%0A%0A".
                            " ✓ Transfer Bank Mandiri%0A".
                            " Norek. 1710013788073%0A".
                            " A/N : Endra Tristyana%0A%0A".
                            " ✓ DANA - (085330748335)%0A%0A".
                            "2. Setor tunai di waroenk joglo 22%0A%0A".
                            "Demikian atas informasinya dan kerjasamanya kami sampaikan terimakasih%0A".
                            "*(Utk pembayaran via transfer dimohon utk menunjukkan bukti transfer dan dikirim lewat WA
                            ini)*%0A%0A".
                            "Salam hormat%0AJoglo.net";
                            } elseif ($t->status === 'Lunas') {
                            $pesan =
                            "Terimakasih Sdr./Bp. {$nama}%0A".
                            "telah memberikan {$nominal} kepada JOGLO.NET_HOTSPOT%0A".
                            "atas Pembayaran tunai iuran wifi bulan {$t->periode}%0A".
                            "pada {$tanggalBayar}.";
                            } else {
                            $pesan = "Tagihan Anda berstatus *{$t->status}*.";
                            }
                            @endphp

                            <!-- Tombol WhatsApp -->
                            <a href="https://wa.me/{{ $t->pelanggan->no_hp }}?text={{ $pesan }}" target="_blank"
                                class="btn btn-success btn-sm">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning bi bi-pencil btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalEditTagihan{{ $t->id }}">
                            </button>

                            <form action="{{ route('tagihan.destroy', $t->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger bi-trash-fill btn-sm"
                                    onclick="return confirm('Yakin hapus?')"></button>
                            </form>
                            <a href="{{ route('tagihan.print', $t->id) }}" target="_blank" class="btn btn-info btn-sm">
                                <i class="bi bi-printer"></i>
                            </a>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Tagihan -->
<div class="modal fade" id="modalTambahTagihan" tabindex="-1" aria-labelledby="modalTambahTagihanLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('tagihan.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahTagihanLabel">Input Tagihan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Pelanggan</label>
                        <select name="pelanggan_id" class="form-control" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach($pelanggan as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_pelanggan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Keterangan / Periode</label>
                        <input type="text" name="periode" class="form-control"
                            placeholder="Misal: Biaya Instalasi / September 2025" required>
                    </div>

                    <div class="form-group">
                        <label>Produk</label>
                        <select name="produk_id" id="produk_id_create" class="form-control" required>
                            <option value="">-- Pilih Produk Wifi --</option>
                            @foreach($produk as $p)
                                <option value="{{ $p->id }}" data-harga="{{ $p->harga }}">{{ $p->kecepatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" readonly required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal_terbit" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Jatuh Tempo</label>
                        <input type="date" name="tanggal_jatuh_tempo" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Belum Lunas">Belum Lunas</option>
                            <option value="Lunas">Lunas</option>
                            <option value="Jatuh Tempo">Jatuh Tempo</option>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Tagihan-->
<!-- Modal Edit Tagihan -->
@foreach($tagihan as $t)
<div class="modal fade" id="modalEditTagihan{{ $t->id }}" tabindex="-1"
    aria-labelledby="modalEditTagihanLabel{{ $t->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('tagihan.update', $t->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTagihanLabel{{ $t->id }}">Edit Tagihan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Pelanggan</label>
                        <select name="pelanggan_id" class="form-control" required>
                            @foreach($pelanggan as $p)
                            <option value="{{ $p->id }}" {{ $t->pelanggan_id == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_pelanggan }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Keterangan / Periode</label>
                        <input type="text" name="periode" class="form-control" value="{{ $t->periode }}" required>
                    </div>

                    <div class="form-group">
                        <label>Produk</label>
                        <select name="produk_id" id="produk_id_edit{{ $t->id }}" class="form-control produk-edit" required>
                            <option value="">-- Pilih Produk Wifi --</option>
                            @foreach($produk as $p)
                                <option value="{{ $p->id }}" data-harga="{{ $p->harga }}"
                                    {{ $t->produk_id == $p->id ? 'selected' : '' }}>
                                    {{ $p->kecepatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="jumlah_tagihan" id="jumlah_tagihan_edit{{ $t->id }}"
                            class="form-control jumlah-edit"
                            value="{{ $t->produk->harga ?? $t->jumlah_tagihan }}" readonly required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal_terbit" class="form-control" value="{{ $t->tanggal_terbit }}" required>
                    </div>

                    <div class="form-group">
                        <label>Jatuh Tempo</label>
                        <input type="date" name="tanggal_jatuh_tempo" class="form-control"
                            value="{{ $t->tanggal_jatuh_tempo }}" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Belum Lunas" {{ $t->status == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                            <option value="Lunas" {{ $t->status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="Jatuh Tempo" {{ $t->status == 'Jatuh Tempo' ? 'selected' : '' }}>Jatuh Tempo</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

<script>
    document.getElementById('produk_id_create').addEventListener('change', function() {
        const harga = this.options[this.selectedIndex].getAttribute('data-harga');
        document.getElementById('jumlah_tagihan_create').value = harga || '';
    });
    </script>

<script>
    document.querySelectorAll('.produk-edit').forEach(select => {
        select.addEventListener('change', function() {
            const harga = this.options[this.selectedIndex].getAttribute('data-harga');
            const id = this.id.replace('produk_id_edit', '');
            const inputHarga = document.getElementById('jumlah_tagihan_edit' + id);
            if (inputHarga) inputHarga.value = harga || '';
        });
    });
    </script>
@endsection
