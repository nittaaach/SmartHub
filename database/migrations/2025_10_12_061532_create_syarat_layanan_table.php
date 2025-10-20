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
        Schema::create('syarat_layanan', function (Blueprint $table) {
            $table->id();// hapus otomatis jika layanan dihapus
            $table->string('nama_dokumen', 255);
            $table->string('lembaran', 50);
            $table->boolean('jenis_berkas')->default(true);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syarat_layanan');
    }
};
