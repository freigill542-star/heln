<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Produk;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KasirTest extends TestCase
{
    use RefreshDatabase;

    public function test_hitung_subtotal(): void
    {
        $harga = 15000;
        $jumlah = 3;

        $subtotal = $harga * $jumlah;

        $this->assertEquals(45000, $subtotal);
    }

    public function test_kurangi_stok(): void
    {
        $produk = Produk::create([
            'nama_produk' => 'Indomie Kuah',
            'harga' => 5000,
            'stok' => 10,
        ]);

        $jumlahBeli = 3;

        $produk->stok -= $jumlahBeli;
        $produk->save();

        $this->assertEquals(7, $produk->fresh()->stok);
    }
}

