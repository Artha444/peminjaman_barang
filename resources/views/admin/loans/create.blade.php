@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <strong><i class="cil-calendar"></i> Form Peminjaman Barang</strong>
            </div>
            <div class="card-body">
                
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('loans.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Pilih Barang</label>
                        <select name="item_id" class="form-select @error('item_id') is-invalid @enderror">
                            <option value="">-- Pilih Barang --</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->code }} - {{ $item->name }} (Stok Tersedia: {{ $item->stock }})
                                </option>
                            @endforeach
                        </select>
                        @error('item_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah Pinjam</label>
                        <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', 1) }}" min="1">
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estimasi Tanggal Kembali</label>
                        <input type="date" name="return_date" class="form-control @error('return_date') is-invalid @enderror" value="{{ old('return_date') }}" min="{{ date('Y-m-d') }}">
                        <small class="text-muted">Kapan Anda berencana mengembalikan barang ini?</small>
                        @error('return_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary text-white">
                            <i class="cil-save"></i> Proses Peminjaman
                        </button>
                        <a href="{{ route('loans.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection