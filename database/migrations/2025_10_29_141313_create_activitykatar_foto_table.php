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
        Schema::create('activitykatar_foto', function (Blueprint $table) {
            $table->id();

            $table->foreignId('activitykatar_id')
                ->constrained('activitykatar')
                ->onDelete('cascade');

            $table->foreignId('activ_fotokatar_id')
                ->constrained('activity_fotokatar')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activitykatar_foto');
    }
};
