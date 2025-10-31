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
        Schema::create('riwayat_inventaris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventaris_id')
                ->constrained('inventariskatar')
                ->onDelete('cascade') 
                ->onUpdate('cascade');

            $table->enum('tipe_transaksi', ['Masuk', 'Keluar', 'Penyesuaian']);
            $table->unsignedInteger('jumlah');

            $table->text('keterangan')->nullable()->comment('Contoh: Dipinjam RW 02, Pembelian, Rusak');
            $table->string('penanggung_jawab', 100)->nullable();
            $table->dateTime('tanggal_transaksi')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_inventaris');
    }
};
