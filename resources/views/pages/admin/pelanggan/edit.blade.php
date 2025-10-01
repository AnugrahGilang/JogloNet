@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="container-fluid">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Pelanggan</h3>
        </div>
        <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-control" value="{{ $pelanggan->nama_pelanggan }}" required>
                </div>
                <div class="form-group">
                    <label>Paket</label>
                    <input type="text" name="paket" class="form-control" value="{{ $pelanggan->paket }}" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ $pelanggan->alamat }}</textarea>
                </div>
                <div class="form-group">
                    <label>Group</label>
                    <input type="text" name="group" class="form-control" value="{{ $pelanggan->group }}" required>
                </div>
                <div class="form-group">
                    <label>Email (Opsional)</label>
                    <input type="email" name="email" class="form-control" value="{{ $pelanggan->email }}">
                </div>
                <div class="form-group">
                    <label>No WhatsApp</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ $pelanggan->no_hp }}" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Pemasangan</label>
                    <input type="date" name="tanggal_pemasangan" class="form-control" value="{{ $pelanggan->tanggal_pemasangan }}" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="Aktif" {{ $pelanggan->status ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ !$pelanggan->status ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
