<div class="form-group mb-3">
    <label>Nama Lengkap</label>
    <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan ?? '') }}" class="form-control">
</div>

<div class="form-group mb-3">
    <label>Paket</label>
    <input type="text" name="paket" value="{{ old('paket', $pelanggan->paket ?? '') }}" class="form-control">
</div>

<div class="form-group mb-3">
    <label>Alamat</label>
    <textarea name="alamat" class="form-control">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
</div>

<div class="form-group mb-3">
    <label>Group</label>
    <input type="text" name="group" value="{{ old('group', $pelanggan->group ?? '') }}" class="form-control">
</div>

<div class="form-group mb-3">
    <label>Email</label>
    <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
</div>

<div class="form-group mb-3">
    <label>Nomor WhatsApp</label>
    <input type="text" name="no_hp" value="{{ old('no_hp', $pelanggan->no_hp ?? '') }}" class="form-control">
</div>

<div class="form-group mb-3">
    <label>Tanggal Pemasangan</label>
    <input type="date" name="tanggal_pemasangan" value="{{ old('tanggal_pemasangan', $pelanggan->tanggal_pemasangan ?? '') }}" class="form-control">
</div>

<div class="form-group mb-3">
    <label>Status</label>
    <input type="text" name="status" value="{{ old('status', $pelanggan->status ?? 'Aktif') }}" class="form-control">
</div>
