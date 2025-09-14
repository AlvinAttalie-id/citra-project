<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StokBarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_barang' => 'CRTV001',
                'slug' => Str::slug('Tumbler Custom Nama + Box Kayu Free Custom'),
                'jenis_barang' => 'Tumbler Custom Nama + Box Kayu Free Custom',
                'jumlah_stok' => 100,
                'harga' => 80000,
            ],
            [
                'kode_barang' => 'CRTV002',
                'slug' => Str::slug('Tumbler LED Hampers Box Kayu Single Custom Laser Grafir'),
                'jenis_barang' => 'Tumbler LED Hampers Box Kayu Single Custom Laser Grafir',
                'jumlah_stok' => 80,
                'harga' => 92000,
            ],
            [
                'kode_barang' => 'CRTV003',
                'slug' => Str::slug('Tumbler Custom LED Hampers Couple Box Kayu Polos Free Kartu Ucapan'),
                'jenis_barang' => 'Tumbler Custom LED Hampers Couple Box Kayu Polos Free Kartu Ucapan',
                'jumlah_stok' => 60,
                'harga' => 110000,
            ],
            [
                'kode_barang' => 'CRTV004',
                'slug' => Str::slug('Tumbler Custom Warna Niagara Hampers Box Kayu Free Custom'),
                'jenis_barang' => 'Tumbler Custom Warna Niagara Hampers Box Kayu Free Custom',
                'jumlah_stok' => 90,
                'harga' => 85000,
            ],
            [
                'kode_barang' => 'CRTV005',
                'slug' => Str::slug('Hampers Tumbler Kayu Box Kayu Custom Grafir'),
                'jenis_barang' => 'Hampers Tumbler Kayu Box Kayu Custom Grafir',
                'jumlah_stok' => 50,
                'harga' => 95000,
            ],
            [
                'kode_barang' => 'CRTV006',
                'slug' => Str::slug('Tumbler Bowling Custom Premium Box Kayu Grafir'),
                'jenis_barang' => 'Tumbler Bowling Custom Premium Box Kayu Grafir',
                'jumlah_stok' => 40,
                'harga' => 135000,
            ],
            [
                'kode_barang' => 'CRTV007',
                'slug' => Str::slug('Tumbler Custom Nama LED Grafir'),
                'jenis_barang' => 'Tumbler Custom Nama LED Grafir',
                'jumlah_stok' => 70,
                'harga' => 100000,
            ],
            [
                'kode_barang' => 'CRTV008',
                'slug' => Str::slug('Tumbler Tutup Kayu Souvenir Promosi Grafir Full Gift Box Set'),
                'jenis_barang' => 'Tumbler Tutup Kayu Souvenir Promosi Grafir Full Gift Box Set',
                'jumlah_stok' => 30,
                'harga' => 85000,
            ],
            [
                'kode_barang' => 'CRTV009',
                'slug' => Str::slug('Tumbler Termos Kayu Custom Grafir Nama Logo Foto Free Desain'),
                'jenis_barang' => 'Tumbler Termos Kayu Custom Grafir Nama Logo Foto Free Desain',
                'jumlah_stok' => 60,
                'harga' => 120000,
            ],
            [
                'kode_barang' => 'CRTV010',
                'slug' => Str::slug('Tumbler Kayu Jati Custom || Botol Minum Custom Nama Logo Tulisan'),
                'jenis_barang' => 'Tumbler Kayu Jati Custom || Botol Minum Custom Nama Logo Tulisan',
                'jumlah_stok' => 50,
                'harga' => 190000,
            ],
            [
                'kode_barang' => 'CRTV011',
                'slug' => Str::slug('Tumbler Kayu Aesthetic Free Custom Grafir Nama'),
                'jenis_barang' => 'Tumbler Kayu Aesthetic Free Custom Grafir Nama',
                'jumlah_stok' => 75,
                'harga' => 85000,
            ],
            [
                'kode_barang' => 'CRTV012',
                'slug' => Str::slug('Tumbler Custom LED Hampers Box Kayu Cetak Laser Grafir Hitam'),
                'jenis_barang' => 'Tumbler Custom LED Hampers Box Kayu Cetak Laser Grafir Hitam',
                'jumlah_stok' => 65,
                'harga' => 95000,
            ],
            [
                'kode_barang' => 'CRTV013',
                'slug' => Str::slug('Tumbler Custom LED Hampers Couple Box Kayu Cetak Laser Grafir Putih'),
                'jenis_barang' => 'Tumbler Custom LED Hampers Couple Box Kayu Cetak Laser Grafir Putih',
                'jumlah_stok' => 55,
                'harga' => 168100,
            ],
            [
                'kode_barang' => 'CRTV014',
                'slug' => Str::slug('Tumbler Custom Nama + Box Kayu Free Custom Putih'),
                'jenis_barang' => 'Tumbler Custom Nama + Box Kayu Free Custom Putih',
                'jumlah_stok' => 100,
                'harga' => 80200,
            ],
            [
                'kode_barang' => 'CRTV015',
                'slug' => Str::slug('Tumbler Custom Nama + Box Kayu Free Custom Hitam'),
                'jenis_barang' => 'Tumbler Custom Nama + Box Kayu Free Custom Hitam',
                'jumlah_stok' => 90,
                'harga' => 40000,
            ],
            [
                'kode_barang' => 'CRTV016',
                'slug' => Str::slug('Tumbler Custom Nama + Box Kayu Free Custom Polos'),
                'jenis_barang' => 'Tumbler Custom Nama + Box Kayu Free Custom Polos',
                'jumlah_stok' => 85,
                'harga' => 75000,
            ],
            [
                'kode_barang' => 'CRTV017',
                'slug' => Str::slug('Hampers Tumbler Kayu Dekayu Botol Minum Kayu Souvenir Corporate'),
                'jenis_barang' => 'Hampers Tumbler Kayu Dekayu Botol Minum Kayu Souvenir Corporate',
                'jumlah_stok' => 45,
                'harga' => 297000,
            ],
            [
                'kode_barang' => 'CRTV018',
                'slug' => Str::slug('Dekayu Hampers Tumbler Kayu with Box'),
                'jenis_barang' => 'Dekayu Hampers Tumbler Kayu with Box',
                'jumlah_stok' => 40,
                'harga' => 255000,
            ],
            [
                'kode_barang' => 'CRTV019',
                'slug' => Str::slug('Tumbler Custom Sakura Nama dan Logo plus Box Kayu Custom'),
                'jenis_barang' => 'Tumbler Custom Sakura Nama dan Logo plus Box Kayu Custom',
                'jumlah_stok' => 30,
                'harga' => 85000,
            ],
            [
                'kode_barang' => 'CRTV020',
                'slug' => Str::slug('Tumbler Custom Niagara Free Custom Grafir Nama'),
                'jenis_barang' => 'Tumbler Custom Niagara Free Custom Grafir Nama',
                'jumlah_stok' => 70,
                'harga' => 88000,
            ],
        ];

        foreach ($data as $item) {
            DB::table('stok_barang')->updateOrInsert(
                ['kode_barang' => $item['kode_barang']],
                $item
            );
        }
    }
}
