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
        Schema::create('suplay_barang', function (Blueprint $table) {
            $table->string('nomor_pengiriman', 20)->primary();
            $table->unsignedBigInteger('id_user'); // suplayer
            $table->string('kode_barang', 20);
            $table->date('tgl_pengiriman');
            $table->integer('jumlah');
            $table->string('keterangan', 100)->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->cascadeOnDelete();
            $table->foreign('kode_barang')->references('kode_barang')->on('stok_barang')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suplay_barang');
    }
};
