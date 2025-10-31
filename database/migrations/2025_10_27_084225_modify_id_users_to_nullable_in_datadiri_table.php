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
        Schema::table('datadiri', function (Blueprint $table) {
            // Perintahkan Laravel untuk mengubah kolom id_users menjadi nullable
            $table->unsignedBigInteger('id_users')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('datadiri', function (Blueprint $table) {
            // (Kembalikan ke not null jika di-rollback)
            $table->unsignedBigInteger('id_users')->nullable(false)->change();
        });
    }
};
