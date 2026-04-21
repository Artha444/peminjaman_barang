@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <strong>Form Peminjaman Barang</strong>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('peminjaman.store') }}">
        @csrf

        <div class="mb-3">
          <label class="form-label">Pilih Barang</label>
          <select name="barang_id" class="form-select" required>
            @foreach($barang as $b)
            <option value="{{ $b->id }}">{{ $b->nama_barang }} (Stok: {{ $b->stok }})</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Jumlah</label>
          <input type="number" name="jumlah" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Pinjam</label>
          <input type="date" name="tanggal_pinjam" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Pinjam Sekarang</button>
      </form>
    </div>
  </div>
</div>
@endsection