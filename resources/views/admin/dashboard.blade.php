@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-primary">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $total_items }}</div>
                        <div>Total Stok Tersedia</div>
                    </div>
                    <i class="cil-storage" style="font-size: 2rem; opacity: 0.3"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-warning">
                <div class="card-body d-flex justify-content-between align-items-start text-dark">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $active_loans }}</div>
                        <div>Peminjaman Aktif</div>
                    </div>
                    <i class="cil-swap-horizontal" style="font-size: 2rem; opacity: 0.3"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-info">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $total_types }}</div>
                        <div>Jenis Kategori</div>
                    </div>
                    <i class="cil-tags" style="font-size: 2rem; opacity: 0.3"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-success">
                <div class="card-body d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $utilization }}%</div>
                        <div>Tingkat Utilisasi</div>
                    </div>
                    <i class="cil-chart-line" style="font-size: 2rem; opacity: 0.3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header fw-bold">
                    <i class="cil-chart-pie me-2"></i>Tren Peminjaman Bulanan
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="loanChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header fw-bold d-flex justify-content-between align-items-center">
                    <span><i class="cil-history me-2"></i>Aktivitas Terbaru</span>
                    <span class="badge bg-secondary">Live</span>
                </div>
                <div class="card-body p-0" style="max-height: 300px; overflow-y: auto;">
                    <ul class="list-group list-group-flush">
                        @forelse($recent_loans as $loan)
                        <li class="list-group-item border-start border-start-4 {{ $loan->status == 'borrowed' ? 'border-start-warning' : 'border-start-success' }}">
                            <div class="d-flex justify-content-between">
                                <div class="small fw-bold">{{ $loan->user->name }}</div>
                                <small class="text-muted">{{ $loan->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="small text-muted">
                                {{ $loan->status == 'borrowed' ? 'Meminjam' : 'Mengembalikan' }} 
                                <strong>{{ $loan->item->name }}</strong>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item text-center text-muted">Belum ada aktivitas</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('loans.index') }}" class="small text-decoration-none">Lihat Semua Riwayat →</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('loanChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chart_labels) !!},
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: {!! json_encode($chart_values) !!},
                    borderColor: '#321fdb',
                    backgroundColor: 'rgba(50, 31, 219, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#321fdb'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
                    x: { grid: { display: false } }
                }
            }
        });
    });
</script>

<style>
    /* Styling tambahan untuk scrollbar agar halus */
    .card-body::-webkit-scrollbar {
        width: 5px;
    }
    .card-body::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .card-body::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }
    .card-body::-webkit-scrollbar-thumb:hover {
        background: #888;
    }
    .border-start-4 {
        border-left-width: 4px !important;
    }
</style>
@endsection