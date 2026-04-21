<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <span class="header-brand fw-bold text-primary">Sistem Logistik</span>
        <ul class="header-nav ms-auto align-items-center">
            
            <li class="nav-item px-3 d-flex align-items-center">
                <div class="text-end me-2">
                    <div class="fw-bold">{{ auth()->user()->name }}</div>
                    <small class="text-muted text-uppercase" style="font-size: 10px">{{ auth()->user()->role }}</small>
                </div>

                <form id="avatarForm" action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="avatarInput" style="cursor: pointer;" title="Klik untuk ganti foto">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}" class="rounded-circle border" width="40" height="40" style="object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold" width="40" height="40" style="width: 40px; height: 40px;">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        @endif
                    </label>
                    <input type="file" name="avatar" id="avatarInput" class="d-none" onchange="document.getElementById('avatarForm').submit()">
                </form>
            </li>

            <li class="nav-item border-start ps-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="cil-account-logout"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</header>