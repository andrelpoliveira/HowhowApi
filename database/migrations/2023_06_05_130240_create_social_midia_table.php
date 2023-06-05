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
        Schema::create('social_midia', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->references('id')->on('users');
            $table->json('youtube_data')->nullable();
            $table->json('instagram_data')->nullable();
            $table->json('facebook_data')->nullable();
            $table->json('kawai_data')->nullable();    
            $table->json('twitch_data')->nullable();
            $table->json('kwai_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_midia');
    }
};
