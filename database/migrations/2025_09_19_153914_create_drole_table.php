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
        Schema::create('drole', function (Blueprint $table) {
<<<<<<< HEAD
            $table->id('id_drole');
=======
            $table->id('id');
>>>>>>> 87ce82732d632cdb7f3956ba3d1115b4cf0b1caa
            $table->string('role')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drole');
    }
};
