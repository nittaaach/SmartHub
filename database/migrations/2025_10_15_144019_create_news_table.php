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
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            // buat kolom foreign key dulu
            $table->unsignedBigInteger('id_users')->nullable();
            $table->unsignedBigInteger('id_knews')->nullable();

            // lalu definisikan relasinya
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_knews')->references('id')->on('k_news')->onDelete('cascade');

            $table->string('title'); // Judul berita
            $table->string('slug')->unique(); // Slug URL
            $table->text('content'); // Isi berita
            $table->string('gambar')->nullable(); // Gambar thumbnail
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->dateTime('published_at')->nullable(); // Tanggal terbit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
