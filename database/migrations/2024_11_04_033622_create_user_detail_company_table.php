<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_detail_company', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique(); // Foreign key to link with users table
            $table->string('company_name');
            $table->string('company_address');
            $table->string('logo_photo')->nullable(); // Store path to logo image
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->text('description')->nullable();
            $table->timestamps();

            // Foreign key constraint to link with the users table
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('user_detail_company');
    }
};