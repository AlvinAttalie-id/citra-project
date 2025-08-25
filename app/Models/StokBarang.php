<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class StokBarang extends Model
{
    use SoftDeletes;

    protected $table = 'stok_barang';
    protected $primaryKey = 'kode_barang';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'kode_barang',
        'jenis_barang',
        'jumlah_stok',
        'harga'
    ];

    // Create a slug based on jenis_barang
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($stok) {
            $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $slug = 'SB-' . $randomNumber;

            while (static::where('slug', $slug)->exists()) {
                $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
                $slug = 'SB-' . $randomNumber;
            }

            $stok->slug = $slug;
        });
    }

    // Define relationships
    public function suplayBarang()
    {
        return $this->hasMany(SuplayBarang::class, 'kode_barang');
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'kode_barang');
    }

    public function returnBarang()
    {
        return $this->hasMany(ReturnBarang::class, 'kode_barang');
    }

    public function barangRusak()
    {
        return $this->hasMany(BarangRusak::class, 'kode_barang');
    }
}
