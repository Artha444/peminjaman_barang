<div class="sidebar sidebar-dark sidebar-fixed border-end" id="sidebar">

    <!-- Brand / Logo -->
    <div class="sidebar-brand d-none d-md-flex align-items-center justify-content-center py-3">
        <div class="d-flex align-items-center">
            <!-- Bisa ganti dengan icon atau logo image -->
            <i class="cil-truck nav-icon fs-4 me-2 text-primary"></i>
            <span class="sidebar-brand-full fw-bold fs-5">LOGISTIK</span>
        </div>
    </div>

    <!-- Divider atas (opsional) -->
    <hr class="sidebar-divider mt-0 mb-2 opacity-25">

    <ul class="sidebar-nav ps-0" data-coreui="navigation">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="cil-speedometer nav-icon"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider + Title untuk Admin -->
        @if(auth()->user()->role === 'admin')
        <li class="nav-title text-uppercase fw-semibold opacity-75 ps-4 mt-3 mb-2">
            Manajemen
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('items.index') }}">
                <i class="cil-storage nav-icon"></i>
                <span>Kelola Barang</span>
            </a>
        </li>
        @endif

        <!-- Divider + Title untuk User biasa -->
        @if(auth()->user()->role === 'user')
        <li class="nav-title text-uppercase fw-semibold opacity-75 ps-4 mt-3 mb-2">
            Transaksi
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('loans.index') }}">
                <i class="cil-swap-horizontal nav-icon"></i>
                <span>Peminjaman</span>
            </a>
        </li>

        @endif

    </ul>

    <!-- Optional: Footer sidebar (misal logout atau info) -->
    <div class="sidebar-footer border-top mt-auto py-3 px-3">
        <small class="text-muted d-block text-center opacity-75">
            © {{ date('Y') }} Logistik App
        </small>
    </div>

</div>