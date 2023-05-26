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
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('belongs_to')->references('id')->on('users');
            $table->json('youtube_posts')->nullable();
            $table->json('instagram_posts')->nullable();
            $table->json('facebook_posts')->nullable();
            $table->json('kawai_posts')->nullable();    
            $table->json('twitch_posts')->nullable();
            $table->json('kwai_posts')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
