@extends('layouts.auth')
@section('content')
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

  <div class="card shadow-sm" style="width: 380px;">
    <div class="card-header text-center bg-white border-0">
      <h2 class="fw-bold mb-0"><span class="text-dark">Joglo</span><span class="text-primary">.net</span></h2>
    </div>
    <div class="card-body">

      <p class="text-center text-muted">Masuk untuk memulai sesi Anda</p>

      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <div class="input-group mb-3">
          <input type="email" name="email" value="{{ old('email') }}"
                 class="form-control @error('email') is-invalid @enderror"
                 placeholder="Email" required autofocus>
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

        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Ingat Saya</label>
          </div>
          <button type="submit" class="btn btn-primary">Masuk</button>
        </div>
      </form>
      <div class="text-center small">
        <a href="#">I forgot my password</a><br>
      </div>
    </div>
  </div>
</body>
@endsection
