# LAPORAN DEBUGGING KASIRKU
_______________________________________________________________________________________________________________________________________________________________________________
| Nama Bug                     | Penyebab                                                | Solusi                                                                    | Status |
|_____________________________________________________________________________________________________________________________________________________________________________|
| Tabel produk tidak ditemukan | Tabel `produks` belum tersedia di database `db_kasirku` | Membuat/menjalankan migration tabel `produks` sesuai model yang digunakan | Fixed  |
|------------------------------|---------------------------------------------------------|---------------------------------------------------------------------------|--------|
| Undefined variable $produks  | Penulisan variabel kurang sehingga variabel yang        | Memperbaiki penulisan variabel menjadi $produks pada Pro                  | Fixed  |
| huruf s                      | digunakan tidak sesuai                                  |                                                                           |        |
|______________________________|_________________________________________________________|____________________________________________________________________________________|
