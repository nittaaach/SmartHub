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
        Schema::table('activity_fotopkk', function (Blueprint $table) {
            // Hapus foreign key dulu (nama constraint bisa bervariasi)
            // Coba cek nama constraint di database Anda jika ini gagal
            $table->dropForeign(['activitypkk_id']);

            // Hapus kolomnya
            $table->dropColumn('activitypkk_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_fotopkk', function (Blueprint $table) {
            //
        });
    }
};
