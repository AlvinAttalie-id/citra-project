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
            $stok->slug = Str::slug($stok->jenis_barang);

            $originalSlug = $stok->slug;
            $count = 1;
            while (static::where('slug', $stok->slug)->exists()) {
                $stok->slug = $originalSlug . '-' . $count++;
            }
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
