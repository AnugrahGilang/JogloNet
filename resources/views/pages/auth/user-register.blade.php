@extends('layouts.auth')
@section('content')
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

  <div class="card shadow-sm" style="width: 380px;">
    <div class="card-header text-center bg-white border-0">
      <h2 class="fw-bold mb-0"><span class="text-dark">Joglo</span><span class="text-success">.net</span></h2>
    </div>
    <div class="card-body">

      <p class="text-center text-muted">Buat akun User baru untuk mulai menggunakan layanan</p>

      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form method="POST" action="{{ route('user.register.post') }}">
        @csrf

        <div class="input-group mb-3">
          <input type="text" name="name" value="{{ old('name') }}"
                 class="form-control @error('name') is-invalid @enderror"
                 placeholder="Nama Lengkap" required autofocus>
          <span class="input-group-text"><i class="bi bi-person"></i></span>
          @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="input-group mb-3">
          <input type="email" name="email" value="{{ old('email') }}"
                 class="form-control @error('email') is-invalid @enderror"
                 placeholder="Email" required>
          <span class="input-group-text"><i class="bi bi-envelope"></i></span>
          @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password"
                 class="form-control @error('password') is-invalid @enderror"
                 placeholder="Password" required>
          <span class="input-group-text"><i class="bi bi-lock"></i></span>
          @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password_confirmation"
                 class="form-control"
                 placeholder="Konfirmasi Password" required>
          <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <a href="{{ route('user.login') }}" class="small">Sudah punya akun? Masuk</a>
          <button type="submit" class="btn btn-success">Daftar</button>
        </div>
      </form>

    </div>
  </div>
</body>
@endsection
