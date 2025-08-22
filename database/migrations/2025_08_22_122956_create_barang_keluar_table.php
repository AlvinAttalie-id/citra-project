<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang_keluar', function (Blueprint $table) {
            $table->id('id_keluar');
            $table->string('kode_barang', 20);
            $table->unsignedBigInteger('id_user'); // admin/petugas
            $table->date('tgl_keluar');
            $table->integer('jumlah');
            $table->string('keterangan', 100)->nullable();
            $table->timestamps();

            $table->foreign('kode_barang')->references('kode_barang')->on('stok_barang')->cascadeOnDelete();
            $table->foreign('id_user')->references('id_user')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar');
    }
};
