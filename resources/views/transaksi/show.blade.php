@extends('layouts.app')

@section('title', 'Detail Transaksi #' . $transaksi->id)

@section('content')
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h5 class="mb-1 fw-bold">Struk Transaksi #{{ str_pad($transaksi->id, 6, '0', STR_PAD_LEFT) }}</h5>
                        <span class="text-muted small">{{ $transaksi->tanggal->format('d/m/Y H:i:s') }}</span>
                    </div>
                    <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Harga Satuan</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi->detailTransaksis as $detail)
                                <tr>
                                    <td class="fw-semibold">{{ $detail->produk->nama_produk ?? '(produk terhapus)' }}</td>
                                    <td class="text-center harga">Rp {{ number_format($detail->produk->harga ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $detail->jumlah }}</td>
                                    <td class="text-end harga">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-success fw-bold">
                                <td colspan="3">TOTAL BAYAR</td>
                                <td class="text-end harga">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card p-4">
                <h6 class="text-muted text-uppercase small fw-bold mb-3">Informasi Transaksi</h6>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Order No</span>
                    <strong class="small">#{{ str_pad($transaksi->id, 6, '0', STR_PAD_LEFT) }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Tanggal</span>
                    <strong class="small">{{ $transaksi->tanggal->format('d/m/Y H:i') }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Jumlah Item</span>
                    <strong class="small">{{ $transaksi->detailTransaksis->count() }} item</strong>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">Total</span>
                    <strong class="fs-5 text-success harga">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</strong>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-success btn-sm flex-fill"><i class="bi bi-printer"></i> Cetak</button>
                    <button class="btn btn-outline-secondary btn-sm flex-fill"><i class="bi bi-share"></i> Bagikan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
