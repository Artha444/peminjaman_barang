<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Register - Sistem Logistik</title>
  <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.6/dist/css/coreui.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-row align-items-center min-vh-100">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card p-4">
          <div class="card-body">
            <h1>Register</h1>
            <p class="text-medium-emphasis">Buat akun baru Anda</p>

            <form action="{{ route('register.post') }}" method="POST">
              @csrf
              <div class="mb-3">
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-3">
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-3">
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-4">
                <input class="form-control" type="password" name="password_confirmation" placeholder="Ulangi Password">
              </div>

              <div class="d-grid gap-2">
                <button class="btn btn-success text-white" type="submit">Daftar Sekarang</button>
                <a href="{{ route('login') }}" class="btn btn-link">Sudah punya akun? Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>