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
        Schema::create('inventariskatar', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->string('kode_barang', 50)->unique();
            $table->string('nama_barang', 255);
            $table->text('deskripsi')->nullable();
            $table->string('satuan', 30)->comment('Contoh: Buah, Unit, Set');
            $table->string('lokasi_penyimpanan', 100)->nullable();

            $table->enum('kondisi', [
                'Baik',
                'Rusak Ringan',
                'Rusak Berat',
                'Hilang'
            ])->default('Baik');

            $table->string('gambar', 255)->nullable();
            $table->date('tanggal_perolehan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventariskatar');
    }
};
