<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnBarang extends Model
{

    use SoftDeletes;

    protected $table = 'return_barang';
    protected $primaryKey = 'id_return';
    public $timestamps = true;

    protected $fillable = [
        'id_keluar',
        'kode_barang',
        'tanggal_r',
        'jumlah',
        'alasan'
    ];

    // Define relationships
    public function barangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class, 'id_keluar');
    }

    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'kode_barang');
    }
}
