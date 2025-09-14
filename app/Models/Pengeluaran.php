<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pengeluaran extends Model
{
    use SoftDeletes;

    protected $table = 'pengeluaran';
    protected $primaryKey = 'id_pengeluaran';
    public $timestamps = true;

    protected $fillable = [
        'slug',
        'jenis_pengeluaran',
        'tgl_pengeluaran',
        'biaya',
        'bukti',
        'id_user',
        'keterangan'
    ];

    // Create a slug based on jenis_pengeluaran
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pengeluaran) {
            $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $slug = 'PG-' . $randomNumber;

            // Cek biar unik
            while (static::where('slug', $slug)->exists()) {
                $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
                $slug = 'PG-' . $randomNumber;
            }

            $pengeluaran->slug = $slug;
        });
    }
}
