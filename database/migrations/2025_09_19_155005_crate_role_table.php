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
<<<<<<< HEAD
         Schema::create('role', function (Blueprint $table) {
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_drole');
            $table->unsignedBigInteger('id_datadiri');
            $table->timestamps();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_drole')->references('id_drole')->on('drole')->onDelete('cascade');
            $table->foreign('id_datadiri')->references('id_datadiri')->on('datadiri')->onDelete('cascade');

            $table->primary(['id_users', 'id_drole', 'id_datadiri']);
=======
        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drole_id')->constrained('drole')->onDelete('cascade');
            $table->foreignId('datadiri_id')->constrained('datadiri')->onDelete('cascade');

            // ✅ gunakan user_id, sesuai kolom id pada tabel users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->timestamps();
>>>>>>> 87ce82732d632cdb7f3956ba3d1115b4cf0b1caa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<< HEAD
         Schema::dropIfExists('role');
=======
        Schema::dropIfExists('role');
>>>>>>> 87ce82732d632cdb7f3956ba3d1115b4cf0b1caa
    }
};
