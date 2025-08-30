<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnBarang extends Model
{
    use SoftDeletes;

    protected $table = 'return_barang';
    protected $primaryKey = 'id_return';
    public $timestamps = true;

    protected $fillable = [
        'id_keluar',
        'kode_barang',
        'kode_return',
        'tanggal_r',
        'jumlah',
        'alasan',
        'id_user', // tambahkan agar bisa diisi
    ];

    // Relasi ke barang keluar
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
        return $this->belongsTo(User::class, 'id_user');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($return) {
            $keluar = $return->barangKeluar;

            if ($keluar) {
                // tidak boleh return jika status complete atau return
                if (in_array($keluar->status, ['complete', 'return'])) {
                    throw new \Exception('Barang keluar ini sudah tidak bisa direturn.');
                }

                // isi otomatis kode_barang
                $return->kode_barang = $keluar->kode_barang;

                // validasi jumlah return
                if ($return->jumlah > $keluar->jumlah) {
                    throw new \Exception('Jumlah return melebihi jumlah barang keluar.');
                }
            }

            // generate kode_return unik
            do {
                $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
                $kodeReturn = 'RB-' . $randomNumber;
            } while (static::where('kode_return', $kodeReturn)->exists());

            $return->kode_return = $kodeReturn;
        });

        static::created(function ($return) {
            // kembalikan stok
            if ($return->stokBarang) {
                $return->stokBarang->increment('jumlah_stok', $return->jumlah);
            }

            // kurangi jumlah di barang keluar
            if ($return->barangKeluar) {
                $return->barangKeluar->jumlah -= $return->jumlah;
                if ($return->barangKeluar->jumlah < 0) {
                    $return->barangKeluar->jumlah = 0;
                }
                $return->barangKeluar->updateStatusAfterReturn();
            }
        });

        static::deleted(function ($return) {
            // rollback stok
            if ($return->stokBarang) {
                $return->stokBarang->decrement('jumlah_stok', $return->jumlah);
                if ($return->stokBarang->jumlah_stok < 0) {
                    $return->stokBarang->jumlah_stok = 0;
                    $return->stokBarang->save();
                }
            }

            // kembalikan jumlah di barang keluar
            if ($return->barangKeluar) {
                $return->barangKeluar->jumlah += $return->jumlah;
                $return->barangKeluar->status = 'process'; // kembalikan jadi process kalau dihapus
                $return->barangKeluar->save();
            }
        });
    }
}
