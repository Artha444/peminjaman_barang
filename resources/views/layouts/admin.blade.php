<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sistem Peminjaman Barang</title>
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.6/dist/css/coreui.min.css" rel="stylesheet">
</head>

<body>
    @include('partials.sidebar')

    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @include('partials.header')

        <div class="body flex-grow-1 px-3">
            <div class="container-lg">
                @yield('content')
            </div>
        </div>

        @include('partials.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.2.6/dist/js/coreui.bundle.min.js"></script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: "{{ session('error') }}",
            confirmButtonColor: '#321fdb'
        });
    </script>
    @endif
</body>

</html>