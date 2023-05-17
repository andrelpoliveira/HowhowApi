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
        Schema::create('campaign_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('influencer_id')->references('id')->on('users');
            $table->unsignedInteger('campaign_id')->references('id')->on('campaigns');
            $table->string('confirmationStatus')->default('0');
            $table->boolean('was_invited')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_participants');
    }
};
