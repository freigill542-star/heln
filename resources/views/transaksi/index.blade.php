@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card p-3 text-center">
                <small class="text-muted text-uppercase fw-semibold">Total Penjualan</small>
                <strong class="fs-4 text-success harga">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</strong>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 text-center">
                <small class="text-muted text-uppercase fw-semibold">Jumlah Transaksi</small>
                <strong class="fs-4">{{ $jumlahTransaksi }} nota</strong>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 text-center">
                <small class="text-muted text-uppercase fw-semibold">Total Unit Terjual</small>
                <strong class="fs-4">{{ $totalUnitTerjual }} item</strong>
            </div>
        </div>
    </div>

    <div class="card p-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-sm btn-light border">Status: All <i class="bi bi-chevron-down"></i></button>
                <button class="btn btn-sm btn-light border">Payment: All <i class="bi bi-chevron-down"></i></button>
                <button class="btn btn-sm btn-light border">Date: 2024/11/08 <i class="bi bi-calendar"></i></button>
                <button class="btn btn-sm btn-light border"><i class="bi bi-funnel"></i> All filters</button>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small">Sort by: Total <i class="bi bi-chevron-down"></i></span>
                <a href="{{ route('transaksi.create') }}" class="btn btn-sm btn-success">
                    <i class="bi bi-plus-lg"></i> Transaksi Baru
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width:40px"><input type="checkbox" class="form-check-input"></th>
                        <th>Order No</th>
                        <th>Tanggal</th>
                        <th class="text-center">Jumlah Item</th>
                        <th class="text-end">Total Bayar</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $transaksi)
                        <tr>
                            <td><input type="checkbox" class="form-check-input"></td>
                            <td class="fw-semibold">#{{ str_pad($transaksi->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td class="text-muted small">{{ $transaksi->tanggal->format('d/m/Y H:i') }}</td>
                            <td class="text-center">{{ $transaksi->detailTransaksis->count() }} item</td>
                            <td class="text-end harga fw-semibold">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span class="status-badge status-success">Selesai</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('transaksi.show', $transaksi) }}" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">{{ $transaksis->links() }}</div>
    </div>
@endsection
