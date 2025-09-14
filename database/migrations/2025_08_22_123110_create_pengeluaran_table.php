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
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id('id_pengeluaran');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->onDelete('set null');
            $table->string('slug')->unique();
            $table->string('jenis_pengeluaran', 100);
            $table->date('tgl_pengeluaran');
            $table->integer('biaya');
            $table->string('bukti', 100)->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};
