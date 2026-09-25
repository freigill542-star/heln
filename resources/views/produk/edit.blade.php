@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card p-4">
                <h5 class="mb-4 fw-bold">Edit Produk: {{ $produk->nama_produk }}</h5>

                <form action="{{ route('produk.update', $produk) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror"
                               value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                        @error('nama_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Harga (Rp)</label>
                        <input type="number" name="harga" min="0" class="form-control @error('harga') is-invalid @enderror"
                               value="{{ old('harga', $produk->harga) }}" required>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Stok</label>
                        <input type="number" name="stok" min="0" class="form-control @error('stok') is-invalid @enderror"
                               value="{{ old('stok', $produk->stok) }}" required>
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-success px-4">Perbarui</button>
                        <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
