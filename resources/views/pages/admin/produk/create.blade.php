@extends('layouts.app')

@section('content')
<div class="p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold mb-4">Tambah Produk WiFi</h1>

    <form action="{{ route('admin.produk.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-semibold">Nama Paket</label>
            <input type="text" name="nama_paket" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold">Kecepatan (Mbps)</label>
            <input type="number" name="kecepatan" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold">Harga</label>
            <input type="number" name="harga" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="deskripsi" class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
