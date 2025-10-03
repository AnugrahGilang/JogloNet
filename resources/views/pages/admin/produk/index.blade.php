@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Produk</h3>
            <div class="card-tools">
                <a href="{{ route('admin.produk.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Produk
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
                        <th>Nama Paket</th>
                        <th>Kecepatan</th>
                        <th>Harga</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->nama_paket }}</td>
                            <td>{{ $p->kecepatan }}</td>
                            <td class="border px-4 py-2">Rp {{ number_format($p->harga,0,',','.') }}</td>
                            <td>
                                <a href="{{ route('admin.produk.edit', $p->id) }}" class="btn btn-warning bi bi-pencil btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.produk.destroy', $p->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
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
                            <td colspan="7" class="text-center">Belum ada data produk</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
