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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('name_artistic')->unique()->nullable();
            $table->string('business_name')->unique()->nullable();

            $table->string('category')->nullable();
            $table->string('line_of_business')->nullable();

            $table->string('email')->unique();
            $table->string('email2')->nullable()->unique();
            $table->string('password');
            $table->string('role')->nullable();
            $table->string('gender')->references('gender')->on('genders');

            $table->string('cpf')->unique()->nullable();
            $table->string('cnpj')->unique()->nullable();

            $table->string('country')->references('country')->on('countries');
            $table->string('state')->references('state')->on('states');
            $table->json('adress')->nullable();
            
            $table->date('birthday')->nullable();

            $table->longText('about_me')->nullable();

            $table->string('landline')->unique()->nullable();
            $table->string('phone')->unique();
            $table->string('phone2')->unique()->nullable();

            $table->string('theme')->default('light');
            $table->string('language')->nullable();

            $table->string('status')->default('0');
            $table->timestamp('email_verified_at')->nullable();

            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('background_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
