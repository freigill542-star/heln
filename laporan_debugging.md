# LAPORAN DEBUGGING KASIRKU

| Nama Bug | Penyebab | Solusi | Status |
|----------|----------|--------|--------|
| Stok Minus | Tidak ada validasi jumlah beli vs stok | Tambah validasi jumlah pembelian tidak boleh melebihi stok | Fixed |
| Eror Subtotal | Variabel harga bertipe string | Ubah tipe data menjadi integer sebelum dikalikan | Fixed |
