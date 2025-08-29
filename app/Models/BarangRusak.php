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
        'keterangan'
    ];

    // Automatically adjust stock when a damaged item is created
    protected static function boot()
    {
        parent::boot();

        static::created(function ($rusak) {
            $stok = $rusak->stokBarang;
            if ($stok) {
                $stok->jumlah_stok -= $rusak->jumlah_rusak;
                if ($stok->jumlah_stok < 0) {
                    $stok->jumlah_stok = 0;
                }
                $stok->save();
            }
        });
    }

    // Define relationships
    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'kode_barang');
    }
}
