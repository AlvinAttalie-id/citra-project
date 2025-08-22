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
            $keluar->slug = Str::slug($keluar->kode_barang . '-' . ($keluar->keterangan ?? 'keluar'));

            $originalSlug = $keluar->slug;
            $count = 1;
            while (static::where('slug', $keluar->slug)->exists()) {
                $keluar->slug = $originalSlug . '-' . $count++;
            }
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
