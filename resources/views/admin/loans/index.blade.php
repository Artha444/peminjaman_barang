@extends('layouts.admin')

@section('content')
<div class="card mb-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <strong>Riwayat Peminjaman</strong>
    <a href="{{ route('loans.create') }}" class="btn btn-primary btn-sm text-white">Buat Peminjaman Baru</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-striped border">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Barang</th>
            <th>Peminjam</th>
            <th>Jumlah</th>
            <th>Tgl Pinjam</th>
            <th>Estimasi Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($loans as $index => $loan)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $loan->item->name ?? 'Item Dihapus' }}</td>
            <td>{{ $loan->user->name ?? 'Guest' }}</td>
            <td>{{ $loan->quantity }}</td>
            <td>{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</td>

            <td>
              @if($loan->return_date)
              @php
              // Hitung apakah terlambat
              $isOverdue = \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($loan->return_date)) && $loan->status == 'borrowed';
              @endphp

              <span class="{{ $isOverdue ? 'text-danger fw-bold' : '' }}">
                {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}
                @if($isOverdue)
                <br><small class="badge bg-danger">Terlambat!</small>
                @endif
              </span>
              @else
              -
              @endif
            </td>

            <td>
              @if($loan->status == 'borrowed')
              <span class="badge bg-warning text-dark">Dipinjam</span>
              @else
              <span class="badge bg-success">Dikembalikan</span>
              @endif
            </td>
            <td>
              @if($loan->status == 'borrowed')
              <form action="{{ route('loans.return', $loan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-sm btn-success text-white">Kembalikan</button>
              </form>
              @else
              <button class="btn btn-sm btn-secondary" disabled>Selesai</button>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="text-center">Belum ada data peminjaman.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: "{{ session('success') }}",
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: true,
    showClass: {
      popup: 'animate__animated animate__fadeInDown'
    },
    hideClass: {
      popup: 'animate__animated animate__fadeOutUp'
    }
  });
</script>
@endif

@if(session('error'))
<script>
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: "{{ session('error') }}",
    confirmButtonColor: '#321fdb'
  });
</script>
@endif