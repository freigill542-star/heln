@extends('layouts.app')

@section('title', 'Transaksi Baru')

@section('content')
    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card p-4">
                <h5 class="mb-4 fw-bold">Form Transaksi Penjualan</h5>

                <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi" novalidate>
                    @csrf

                    @error('produk_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="table-responsive">
                        <table class="table align-middle" id="tabelItem">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:55%">Produk</th>
                                    <th style="width:20%">Jumlah Beli</th>
                                    <th class="text-end" style="width:20%">Subtotal</th>
                                    <th style="width:5%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="baris-item">
                                    <td>
                                        <select name="produk_id[]" class="form-select select-produk" required>
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach ($produks as $produk)
                                                <option value="{{ $produk->id }}"
                                                        data-harga="{{ $produk->harga }}"
                                                        data-stok="{{ $produk->stok }}"
                                                        data-nama="{{ $produk->nama_produk }}">
                                                    {{ $produk->nama_produk }} — Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                                    (stok {{ $produk->stok }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="jumlah[]" class="form-control input-jumlah"
                                               min="1" value="1" required>
                                        <small class="text-muted stok-info"></small>
                                    </td>
                                    <td class="text-end harga subtotal-item">Rp 0</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-hapus" title="Hapus baris">&times;</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <button type="button" class="btn btn-outline-success btn-sm" id="tambahItem">
                        <i class="bi bi-plus-lg"></i> Tambah Item
                    </button>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn btn-success px-4">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card p-4">
                <h6 class="text-muted text-uppercase small fw-bold">Ringkasan</h6>
                <p class="mb-1 small">Jumlah item: <strong id="infoItem">0</strong></p>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-6">Total Bayar</span>
                    <strong class="fs-4 text-success harga" id="infoTotal">Rp 0</strong>
                </div>
                <p class="text-muted small mt-3 mb-0">
                    Total ini adalah perhitungan sementara. Angka final tetap dihitung ulang oleh
                    server saat tombol <em>Simpan Transaksi</em> ditekan.
                </p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
(function () {
    const rupiah = n => 'Rp ' + Number(n).toLocaleString('id-ID');
    const tbodyItem = document.querySelector('#tabelItem tbody');
    const infoTotal = document.getElementById('infoTotal');
    const infoItem  = document.getElementById('infoItem');

    function hitungTotal() {
        let total = 0, item = 0;
        tbodyItem.querySelectorAll('.baris-item').forEach(baris => {
            const select = baris.querySelector('.select-produk');
            const jumlah = parseInt(baris.querySelector('.input-jumlah').value || 0, 10);
            const harga = parseInt(select.selectedOptions[0]?.dataset.harga || 0, 10);
            const subtotal = harga * jumlah;
            baris.querySelector('.subtotal-item').textContent = rupiah(subtotal);
            total += subtotal;
            if (select.value && jumlah > 0) item++;
        });
        infoTotal.textContent = rupiah(total);
        infoItem.textContent = item;
    }

    function batasiStok(baris) {
        const select = baris.querySelector('.select-produk');
        const input  = baris.querySelector('.input-jumlah');
        const opsi   = select.selectedOptions[0];
        if (opsi && opsi.dataset.stok) {
            const stok = parseInt(opsi.dataset.stok, 10);
            input.max = stok;
            baris.querySelector('.stok-info').textContent = 'Maks. ' + stok;
            if (parseInt(input.value, 10) > stok) input.value = stok;
        } else {
            input.removeAttribute('max');
            baris.querySelector('.stok-info').textContent = '';
        }
    }

    tbodyItem.addEventListener('change', e => {
        if (e.target.matches('.select-produk')) batasiStok(e.target.closest('.baris-item'));
        hitungTotal();
    });
    tbodyItem.addEventListener('input', e => {
        if (e.target.matches('.input-jumlah')) hitungTotal();
    });
    tbodyItem.addEventListener('click', e => {
        if (e.target.matches('.btn-hapus') && tbodyItem.querySelectorAll('.baris-item').length > 1) {
            e.target.closest('.baris-item').remove();
            hitungTotal();
        }
    });

    document.getElementById('tambahItem').addEventListener('click', () => {
        const barisBaru = tbodyItem.querySelector('.baris-item').cloneNode(true);
        barisBaru.querySelector('.select-produk').value = '';
        barisBaru.querySelector('.input-jumlah').value = 1;
        barisBaru.querySelector('.stok-info').textContent = '';
        tbodyItem.appendChild(barisBaru);
        hitungTotal();
    });

    document.getElementById('formTransaksi').addEventListener('submit', function (e) {
        const kosong = [...tbodyItem.querySelectorAll('.select-produk')].some(s => s.value === '');
        if (kosong) {
            e.preventDefault();
            alert('Semua baris harus memilih produk terlebih dahulu.');
        }
    });

    hitungTotal();
})();
</script>
@endpush
