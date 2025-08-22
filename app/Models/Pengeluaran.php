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
        'keterangan'
    ];

    // Create a slug based on jenis_pengeluaran
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pengeluaran) {
            $pengeluaran->slug = Str::slug($pengeluaran->jenis_pengeluaran);

            $originalSlug = $pengeluaran->slug;
            $count = 1;
            while (static::where('slug', $pengeluaran->slug)->exists()) {
                $pengeluaran->slug = $originalSlug . '-' . $count++;
            }
        });
    }
}
