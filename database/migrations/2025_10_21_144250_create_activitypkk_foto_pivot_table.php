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
            
            $table->foreignId('activitypkk_id')
                  ->constrained('activitypkk')
                  ->onDelete('cascade');
            
            $table->foreignId('activ_fotopkk_id')
                  ->constrained('activity_fotopkk') 
                  ->onDelete('cascade');
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
