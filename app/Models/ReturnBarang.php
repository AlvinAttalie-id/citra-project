<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnBarang extends Model
{
    use SoftDeletes;

    protected $table = 'return_barang';
    protected $primaryKey = 'id_return';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'id_keluar',
        'kode_barang',
        'kode_return',
        'tanggal_r',
        'jumlah',
        'alasan',
        'id_user',
    ];

    public function barangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class, 'id_keluar');
    }

    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'kode_barang', 'kode_barang');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($return) {
            $keluar = $return->barangKeluar;

            if ($keluar) {
                if (in_array($keluar->status, ['complete', 'return'])) {
                    throw new \Exception('Barang keluar ini sudah tidak bisa direturn.');
                }

                $return->kode_barang = $keluar->kode_barang;

                if ($return->jumlah > $keluar->jumlah) {
                    throw new \Exception('Jumlah return melebihi jumlah barang keluar.');
                }
            }

            do {
                $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
                $kodeReturn = 'RB-' . $randomNumber;
            } while (static::where('kode_return', $kodeReturn)->exists());

            $return->kode_return = $kodeReturn;
        });

        static::created(function ($return) {
            if ($return->stokBarang) {
                $return->stokBarang->increment('jumlah_stok', $return->jumlah);
            }

            if ($return->barangKeluar) {
                $return->barangKeluar->jumlah -= $return->jumlah;
                if ($return->barangKeluar->jumlah < 0) {
                    $return->barangKeluar->jumlah = 0;
                }
                $return->barangKeluar->updateStatusAfterReturn();
            }
        });

        static::deleted(function ($return) {
            if ($return->stokBarang) {
                $return->stokBarang->decrement('jumlah_stok', $return->jumlah);
                if ($return->stokBarang->jumlah_stok < 0) {
                    $return->stokBarang->jumlah_stok = 0;
                    $return->stokBarang->save();
                }
            }

            if ($return->barangKeluar) {
                $return->barangKeluar->jumlah += $return->jumlah;
                $return->barangKeluar->status = 'process';
                $return->barangKeluar->save();
            }
        });
    }
}
