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
        Schema::create('lamar', function (Blueprint $table) {
            $table->id('id_lamar');
            $table->foreignId('id_user')->constrained('user');
            $table->foreignId('id_jobs')->constrained('jobs');
            $table->string('cv');
            $table->string('link')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamar');
    }
};
