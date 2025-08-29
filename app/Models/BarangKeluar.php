<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengeluaran;
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
        'keterangan',
        'status'
    ];

    // Create a slug based on kode_barang and keterangan
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($keluar) {
            // Isi id_user otomatis
            $keluar->id_user = Auth::id();

            // Set status default = process
            $keluar->status = 'process';   // 🔹 otomatis "process"

            // Generate slug untuk Barang Keluar
            $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $slug = 'BK-' . $randomNumber;

            while (static::where('slug', $slug)->exists()) {
                $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
                $slug = 'BK-' . $randomNumber;
            }

            $keluar->slug = $slug;
        });

        static::created(function ($keluar) {
            // Kurangi stok
            $stok = $keluar->stokBarang;
            if ($stok) {
                $stok->jumlah_stok -= $keluar->jumlah;
                if ($stok->jumlah_stok < 0) {
                    $stok->jumlah_stok = 0;
                }
                $stok->save();
            }

            // Buat Pengeluaran otomatis
            Pengeluaran::create([
                'jenis_pengeluaran' => 'Transportasi Pengiriman',
                'tgl_pengeluaran'   => $keluar->tgl_keluar,
                'biaya'             => 20000,
                'bukti'             => 'bukti-kosong.png',
                'keterangan'        => $keluar->keterangan,
            ]);
        });
    }

    // Update status barang if jumlah is 0 after return
    public function updateStatusAfterReturn()
    {
        if ($this->jumlah <= 0) {
            $this->status = 'return';
        }
        $this->save();
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
