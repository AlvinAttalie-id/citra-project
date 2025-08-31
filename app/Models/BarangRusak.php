<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangRusak extends Model
{
    use SoftDeletes;

    protected $table = 'barang_rusak';
    protected $primaryKey = 'id_return';
    public $timestamps = true;

    protected $fillable = [
        'kode_barang',
        'jumlah_rusak',
        'tanggal',
        'keterangan',
        'id_user',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($rusak) {
            // Kurangi stok
            $stok = $rusak->stokBarang;
            if ($stok) {
                $stok->jumlah_stok -= $rusak->jumlah_rusak;
                if ($stok->jumlah_stok < 0) {
                    $stok->jumlah_stok = 0;
                }
                $stok->save();
            }

            // Buat pengeluaran otomatis
            Pengeluaran::create([
                'jenis_pengeluaran' => 'Pemusnahan Barang Rusak',
                'tgl_pengeluaran'   => $rusak->tanggal,
                'biaya'             => 50000,
                'bukti'             => 'bukti-kosong.png',
                'keterangan'        => $rusak->keterangan,
                'id_user'           => $rusak->id_user,
            ]);
        });
    }

    // Relasi ke stok barang
    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'kode_barang', 'kode_barang');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
