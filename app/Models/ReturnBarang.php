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
        'alasan'
    ];

    public function barangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class, 'id_keluar');
    }

    public function stokBarang()
    {
        return $this->belongsTo(StokBarang::class, 'kode_barang');
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

            // generate kode_return
            $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $kodeReturn = 'RB-' . $randomNumber;
            while (static::where('kode_return', $kodeReturn)->exists()) {
                $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
                $kodeReturn = 'RB-' . $randomNumber;
            }
            $return->kode_return = $kodeReturn;
        });

        static::created(function ($return) {
            // kembalikan stok
            $stok = $return->stokBarang;
            if ($stok) {
                $stok->jumlah_stok += $return->jumlah;
                $stok->save();
            }

            // kurangi jumlah di barang keluar
            $keluar = $return->barangKeluar;
            if ($keluar) {
                $keluar->jumlah -= $return->jumlah;
                if ($keluar->jumlah < 0) {
                    $keluar->jumlah = 0;
                }
                $keluar->updateStatusAfterReturn();
            }
        });

        static::deleted(function ($return) {
            // rollback stok
            $stok = $return->stokBarang;
            if ($stok) {
                $stok->jumlah_stok -= $return->jumlah;
                if ($stok->jumlah_stok < 0) {
                    $stok->jumlah_stok = 0;
                }
                $stok->save();
            }

            // kembalikan jumlah di barang keluar
            $keluar = $return->barangKeluar;
            if ($keluar) {
                $keluar->jumlah += $return->jumlah;
                $keluar->status = 'process'; // kembalikan jadi process kalau dihapus
                $keluar->save();
            }
        });
    }
}
