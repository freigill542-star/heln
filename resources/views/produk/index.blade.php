@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div class="card p-3">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('produk.create') }}" class="btn btn-sm btn-success">
                    <i class="bi bi-plus-lg"></i> Tambah Produk
                </a>
            </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th class="text-end">Harga (Rp)</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produks as $produk)
                        <tr>
                            <td class="text-muted">#{{ str_pad($produk->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:34px;height:34px;">
                                        <i class="bi bi-box text-secondary"></i>
                                    </div>
                                    <span class="fw-semibold">{{ $produk->nama_produk }}</span>
                                </div>
                            </td>
                            <td class="text-end harga">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span class="badge {{ $produk->stok > 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                    {{ $produk->stok }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if ($produk->stok > 0)
                                    <span class="status-badge status-success">Tersedia</span>
                                @else
                                    <span class="status-badge status-danger">Habis</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('produk.edit', $produk) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('produk.destroy', $produk) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Hapus produk {{ $produk->nama_produk }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada produk. Tambahkan dulu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $produks->links() }}</div>
    </div>
@endsection
