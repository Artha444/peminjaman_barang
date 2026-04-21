<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login - Sistem Peminjaman</title>
  <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.6/dist/css/coreui.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-row align-items-center min-vh-100">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card p-4">
          <div class="card-body">
            <h1>Login</h1>
            <p class="text-medium-emphasis">Masuk ke akun Anda</p>

            <form action="{{ route('login.post') }}" method="POST">
              @csrf
              <div class="input-group mb-3">
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="input-group mb-4">
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="row">
                <div class="col-12 d-grid">
                  <button class="btn btn-primary text-white" type="submit">Login</button>
                  <div class="row mt-3">
                    <div class="col-12 text-center">
                      <span>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></span>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>