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
        Schema::table('layanan', function (Blueprint $table) {
            // 1. Hapus Foreign Key Constraint-nya dulu
            //    (Nama constraint-nya kita dapat dari pesan error)
            $table->dropForeign('layanan_id_template_foreign');

            // 2. Baru hapus kolomnya
            $table->dropColumn('id_template');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('layanan', function (Blueprint $table) {
            // Untuk rollback jika terjadi kesalahan
            $table->unsignedBigInteger('id_template')->nullable()->after('status_aktif');
        });
    }
};
