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
        Schema::create('activity_fotopkk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activitypkk_id')->nullable();
            $table->string('fotopkk'); // path file
            $table->string('caption')->nullable();
            $table->timestamps();

            $table->foreign('activitypkk_id')->references('id')->on('activitypkk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_fotopkk');
    }
};
