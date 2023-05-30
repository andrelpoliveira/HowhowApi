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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('marca_id')->references('id')->on('users');
            $table->string('name')->unique();
            $table->string('brand_name');

            $table->longText('brand_info')->nullable();
            $table->longText('campaign_purpose')->nullable();

            $table->json('country')->nullable();
            $table->json('states')->nullable();
            $table->longText('line_of_business');
            $table->json('social_media')->nullable();
            $table->json('content_type')->nullable();

            $table->boolean('private')->default(0);
            $table->boolean('ended')->default(0);

            $table->longText('campaign_photo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campanhas');
    }
};
