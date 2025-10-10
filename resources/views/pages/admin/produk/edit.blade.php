@extends('layouts.app')

@section('title', 'Edit Produk WiFi')

@section('content')
<div class="container-fluid">

    {{-- Alert Sukses --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    {{-- Alert Error Validasi --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Ups!</strong> Ada kesalahan pada input Anda:
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Produk WiFi</h3>
        </div>

        <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Paket</label>
                    <input type="text" name="nama_paket" value="{{ old('nama_paket', $produk->nama_paket) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Kecepatan (Mbps)</label>
                    <input type="number" name="kecepatan" value="{{ old('kecepatan', $produk->kecepatan) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-warning">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection
