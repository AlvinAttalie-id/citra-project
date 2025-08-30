<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang_rusak', function (Blueprint $table) {
            // tambahkan user_id tanpa after('id') karena kolomnya bukan 'id'
            $table->unsignedBigInteger('id_user')->nullable()->after('id_return');

            $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('barang_rusak', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');
        });
    }
};
