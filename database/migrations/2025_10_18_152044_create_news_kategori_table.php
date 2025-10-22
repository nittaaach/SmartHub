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
        Schema::create('news_kategori', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_id');
            $table->unsignedBigInteger('k_news_id');
            $table->timestamps();

            // Relasi foreign key
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->foreign('k_news_id')->references('id')->on('k_news')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_kategori');
    }
};
