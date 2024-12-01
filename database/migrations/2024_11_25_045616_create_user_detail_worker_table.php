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
        Schema::create('user_detail_worker', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedInteger('user_id')->unique();
            $table->string('nama');
            $table->string('tgllahir');
            $table->string('alamat');
            $table->string('logo_photo')->nullable();
            $table->string('notelp');
            $table->string('deskripsi');
            $table->string('link')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_detail_worker');
    }
};
