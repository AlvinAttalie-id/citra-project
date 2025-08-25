<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BarangKeluar extends Model
{
    use SoftDeletes;

    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_keluar';
    public $timestamps = true;

    protected $fillable = [
        'slug',
        'kode_barang',
        'id_user',
        'tgl_keluar',
        'jumlah',
        'keterangan'
    ];

    // Create a slug based on kode_barang and keterangan
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($keluar) {
            // Generate angka random 1–99999, lalu format jadi 5 digit (leading zero)
            $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

            // Bentuk slug = BK-XXXXX
            $slug = 'BK-' . $randomNumber;

            // Cek biar unik
            while (static::where('slug', $slug)->exists()) {
                $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
                $slug = 'BK-' . $randomNumber;
            }

            $keluar->slug = $slug;
        });
    }

    // Define relationships
    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'kode_barang');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function returnBarang()
    {
        return $this->hasMany(ReturnBarang::class, 'id_keluar');
    }
}
