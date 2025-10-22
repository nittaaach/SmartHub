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
        Schema::create('activitypkk_foto', function (Blueprint $table) {
            $table->id();
            
            // Foreign key ke tabel activitypkk
            $table->foreignId('activitypkk_id')
                  ->constrained('activitypkk') // 'activitypkk' adalah nama tabel Anda
                  ->onDelete('cascade');
            
            // Foreign key ke tabel activity_fotopkk
            $table->foreignId('activ_fotopkk_id')
                  ->constrained('activity_fotopkk') // 'activity_fotopkk' adalah nama tabel Anda
                  ->onDelete('cascade');
            
            // Opsional, tapi bagus
            // $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activitypkk_foto_pivot');
    }
};
