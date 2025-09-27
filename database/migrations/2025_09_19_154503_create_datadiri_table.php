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
        Schema::create('datadiri', function (Blueprint $table) {
<<<<<<< HEAD
            $table->id('id_datadiri');
            $table->unsignedBigInteger('id_users');
=======
            $table->id('id');
            $table->unsignedBigInteger('user_id');
>>>>>>> 87ce82732d632cdb7f3956ba3d1115b4cf0b1caa
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('notelp')->unique();
            $table->text('alamat')->nullable();
            $table->timestamps();

<<<<<<< HEAD
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
=======
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
>>>>>>> 87ce82732d632cdb7f3956ba3d1115b4cf0b1caa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datadiri');
    }
};
