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
        Schema::create('struktural', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_datadiri'); // relasi ke tabel datadiri
            $table->string('jabatan'); // misalnya: sekretaris, bendahara
            $table->string('tingkatan'); // misalnya: rt, rw, pkk
            $table->string('gambar')->nullable(); // foto/gambar opsional
            $table->timestamps();

            $table->foreign('id_datadiri')
                ->references('id')->on('datadiri')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('struktural');
    }
};
