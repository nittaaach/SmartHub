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
         Schema::create('role', function (Blueprint $table) {
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_drole');
            $table->unsignedBigInteger('id_datadiri');
            $table->timestamps();

            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_drole')->references('id_drole')->on('drole')->onDelete('cascade');
            $table->foreign('id_datadiri')->references('id_datadiri')->on('datadiri')->onDelete('cascade');

            $table->primary(['id_users', 'id_drole', 'id_datadiri']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('role');
    }
};
