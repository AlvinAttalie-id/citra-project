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
        Schema::create('return_barang', function (Blueprint $table) {
            $table->id('id_return');
            $table->unsignedBigInteger('id_keluar');
            $table->string('kode_barang', 20);
            $table->date('tanggal_r');
            $table->integer('jumlah');
            $table->string('alasan', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('kode_return', 50)->unique();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->cascadeOnDelete();
            $table->foreign('id_keluar')->references('id_keluar')->on('barang_keluar')->cascadeOnDelete();
            $table->foreign('kode_barang')->references('kode_barang')->on('stok_barang')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_barang');
    }
};
