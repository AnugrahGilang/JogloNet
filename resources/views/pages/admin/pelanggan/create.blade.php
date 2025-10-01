@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

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

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Tambah Pelanggan</h3>
        </div>
        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_pelanggan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Paket</label>
                    <input type="text" name="paket" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label>Group</label>
                    <input type="text" name="group" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Nomer WhatsApp</label>
                    <input type="text" name="no_hp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Pemasangan</label>
                    <input type="date" name="tanggal_pemasangan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Nonaktif</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
