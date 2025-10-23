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
        Schema::create('jadwalpkk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->string('kategori');
            $table->string('target_peserta', 150)->nullable()
                ->comment('Misal: Kader PKK, Warga RW 12, Umum');
            $table->text('deskripsi')->nullable();

            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai')->nullable();

            $table->string('lokasi');
            $table->string('penanggung_jawab', 150)->nullable();

            $table->enum('status', [
                'Terjadwal',
                'Berlangsung',
                'Selesai',
                'Dibatalkan',
                'Ditunda'
            ])->default('Terjadwal');

            $table->dateTime('tanggal_tunda')->nullable()
                ->comment('Diisi jika status = Ditunda');

            $table->text('catatan')->nullable();

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwalpkk');
    }
};
