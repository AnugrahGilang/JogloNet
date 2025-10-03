@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Profil Saya</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($pelanggan)
                <p><b>Nama:</b> {{ $pelanggan->nama_pelanggan }}</p>
                <p><b>Email:</b> {{ $pelanggan->email }}</p>
                <p><b>No HP:</b> {{ $pelanggan->no_hp }}</p>
                <p><b>Alamat:</b> {{ $pelanggan->alamat }}</p>
                <p><b>Paket:</b> {{ $pelanggan->paket }}</p>
                <p><b>Status:</b> {{ $pelanggan->status }}</p>

                <!-- Tombol edit -->
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>

                <!-- Tombol hapus -->
                <form action="{{ route('user.profile.destroy') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            @else
                <p>Anda belum mengisi informasi pelanggan.</p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Buat Profil</button>
            @endif
        </div>
    </div>
</div>

{{-- Modal Create --}}
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('user.profile.store') }}" method="POST">
        @csrf
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="createModalLabel">Buat Profil Pelanggan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @include('pages.user.profile.partials.form', ['pelanggan' => null])
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Modal Edit --}}
@if($pelanggan)
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('user.profile.update') }}" method="POST">
        @csrf
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title" id="editModalLabel">Edit Profil Pelanggan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            @include('pages.user.profile.partials.form', ['pelanggan' => $pelanggan])
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endif
@endsection
