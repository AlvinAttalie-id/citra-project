<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('barang_keluar', function (Blueprint $table) {
            $table->enum('status', ['process', 'complete', 'return'])
                ->default('process')
                ->after('keterangan');
        });
    }

    public function down()
    {
        Schema::table('barang_keluar', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
