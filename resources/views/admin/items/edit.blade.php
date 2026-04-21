@extends('layouts.admin')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-header">
        <strong>Edit Barang</strong>
      </div>
      <div class="card-body">
        <form action="{{ route('items.update', $item->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label class="form-label">Kode Barang</label>
            <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code', $item->code) }}">
            @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $item->name) }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock', $item->stock) }}" min="0">
            @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" name="description" rows="3">{{ old('description', $item->description) }}</textarea>
          </div>

          <button type="submit" class="btn btn-primary text-white">Update</button>
          <a href="{{ route('items.index') }}" class="btn btn-secondary">Batal</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection