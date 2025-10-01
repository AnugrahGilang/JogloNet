@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Pelanggan</h3>
            <div class="card-tools">
                <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Pelanggan
                </a>
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
                        <th>Nama Pelanggan</th>
                        <th>Paket</th>
                        <th>Alamat</th>
                        <th>Group</th>
                        <th>No WhatsApp</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->nama_pelanggan }}</td>
                            <td>{{ $p->paket }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>{{ $p->group }}</td>
                            <td>{{ $p->no_hp }}</td>
                            <td>
                                @if($p->status === 'Aktif')
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Nonaktif</span>
                            @endif
                            </td>
                            <td>
                                <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn btn-warning bi bi-pencil btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger bi-trash-fill btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data pelanggan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
