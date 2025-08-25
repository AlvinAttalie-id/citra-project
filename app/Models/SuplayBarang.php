<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class SuplayBarang extends Model
{

    use SoftDeletes;

    protected $table = 'suplay_barang';
    protected $primaryKey = 'nomor_pengiriman';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'nomor_pengiriman',
        'id_user',
        'kode_barang',
        'tgl_pengiriman',
        'jumlah',
        'keterangan'
    ];

    // Create a slug based on nomor_pengiriman
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($suplay) {
            $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $slug = 'SBR-' . $randomNumber;

            while (static::where('slug', $slug)->exists()) {
                $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
                $slug = 'SBR-' . $randomNumber;
            }

            $suplay->slug = $slug;
        });
    }

    // Define relationships
    public function supplier()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'kode_barang');
    }
}
