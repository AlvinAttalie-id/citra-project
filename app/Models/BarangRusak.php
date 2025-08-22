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

    // Define relationships
    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'kode_barang');
    }
}
