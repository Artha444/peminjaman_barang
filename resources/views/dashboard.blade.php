@extends('layouts.app')

@section('header')
<!-- Optional: tambah title atau breadcrumb -->
<h1 class="m-0">Dashboard Peminjaman Barang</h1>
@endsection

@section('content')
<div class="container-fluid">
  <!-- Row 1: Cards statistik -->
  <div class="row">
    <div class="col-sm-6 col-lg-3">
      <div class="card text-white bg-primary">
        <div class="card-body pb-0">
          <div class="fs-4 fw-semibold">{{ $totalBarang }}</div>
          <div>Total Barang</div>
        </div>
        <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
          <!-- Optional: bisa tambah mini chart nanti -->
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card text-white bg-info">
        <div class="card-body pb-0">
          <div class="fs-4 fw-semibold">{{ $stokTersedia }}</div>
          <div>Stok Tersedia</div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card text-white bg-warning">
        <div class="card-body pb-0">
          <div class="fs-4 fw-semibold">{{ $barangDipinjam }}</div>
          <div>Barang Dipinjam</div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-lg-3">
      <div class="card text-white bg-danger">
        <div class="card-body pb-0">
          <div class="fs-4 fw-semibold">{{ $peminjamanAktif }}</div>
          <div>Peminjaman Aktif</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Row 2: Peminjaman terbaru & stok menipis -->
  <div class="row mt-4">
    <!-- Peminjaman Terbaru -->
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">
          <strong>Peminjaman Terbaru (Belum Dikembalikan)</strong>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Peminjam</th>
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Tgl Pinjam</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse($peminjamanTerbaru as $p)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $p->user?->name ?? 'User dihapus' }}</td>
                  <td>{{ $p->barang?->nama_barang }}</td>
                  <td>{{ $p->jumlah }}</td>
                  <td>{{ $p->tanggal_pinjam->format('d M Y') }}</td>
                  <td>
                    <span class="badge bg-warning">Dipinjam</span>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center">Belum ada peminjaman aktif</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Stok Menipis -->
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header bg-warning text-white">
          <strong>Stok Hampir Habis</strong>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            @forelse($barangStokMenipis as $b)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ $b->nama_barang }}
              <span class="badge bg-danger rounded-pill">{{ $b->stok }} pcs</span>
            </li>
            @empty
            <li class="list-group-item text-center">Semua stok aman ✓</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection