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
        Schema::create('nonktp_rw12', function (Blueprint $table) {
            $table->id();
            $table->string('rt');
            $table->integer('jumlah');
            $table->integer('laki_laki');   // gunakan underscore, bukan tanda minus
            $table->integer('perempuan');
            $table->integer('jumlah_kk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nonktp_rw12');
    }
};
