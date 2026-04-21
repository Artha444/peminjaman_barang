@extends('layouts.admin')

@section('content')

<div class="row">
    <!-- Statistik Utama -->
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">{{ $total_items }}</div>
                    <div>Total Stok Barang</div>
                </div>
                <div class="fs-5 fw-semibold">Barang</div>
            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:40px;">
                <!-- Bisa tambah sparkline/chart kecil nanti via JS -->
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">{{ $total_types }}</div>
                    <div>Jenis Barang</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-warning">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">{{ $active_loans }}</div>
                    <div>Sedang Dipinjam</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-danger">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">{{ $overdue_loans }}</div>
                    <div>Terlambat Kembali</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">Peminjaman Terbaru (Semua User)</div>
            <div class="card-body">
                <table class="table table-hover border">
                    <thead class="table-light">
                        <tr>
                            <th>Peminjam</th>
                            <th>Barang</th>
                            <th>Status</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_loans as $loan)
                        <tr>
                            <td>{{ $loan->user->name }}</td>
                            <td>{{ $loan->item->name }}</td>
                            <td>
                                <span class="badge rounded-pill 
                                    {{ $loan->status == 'borrowed' ? 'bg-warning' : 'bg-success' }}">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </td>
                            <td>{{ $loan->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">Belum ada peminjaman</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">Barang Paling Sering Dipinjam</div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse($top_borrowed as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item->item->name }}
                        <span class="badge bg-primary rounded-pill">{{ $item->total }}×</span>
                    </li>
                    @empty
                    <li class="list-group-item text-center">Belum ada data</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Bisa tambah widget lain: misal Progress stok rendah -->
        <div class="card mb-4">
            <div class="card-header">Stok Hampir Habis</div>
            <div class="card-body">
                <!-- Query stok < 5 misalnya, tampilkan progress bar -->
            </div>
        </div>
    </div>
</div>

@endsection