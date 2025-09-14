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
        'slug',
        'id_user',
        'kode_barang',
        'tgl_pengiriman',
        'jumlah',
        'keterangan',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate nomor_pengiriman & slug otomatis
        static::creating(function ($suplay) {

            $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $nomorPengiriman = 'SPY-' . $randomNumber;

            while (static::where('nomor_pengiriman', $nomorPengiriman)->exists()) {
                $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
                $nomorPengiriman = 'SPY-' . $randomNumber;
            }

            $suplay->nomor_pengiriman = $nomorPengiriman;

            // slug otomatis dari nomor_pengiriman
            $slug = Str::slug($nomorPengiriman);
            $count = 1;

            while (static::where('slug', $slug)->exists()) {
                $slug = Str::slug($nomorPengiriman) . '-' . $count++;
            }

            $suplay->slug = $slug;
        });

        // Update stok barang otomatis ketika ada suplay baru
        static::created(function ($suplay) {
            $stok = $suplay->stokBarang;
            if ($stok) {
                $stok->jumlah_stok += $suplay->jumlah;
                $stok->save();
            }
        });
    }

    // Relationships
    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'kode_barang');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
