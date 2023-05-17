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
        Schema::create('campanhas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('marca_id')->references('id')->on('users');
            $table->string('name')->unique();
            $table->string('brand_name');

            $table->string('budget');
            $table->longText('brand_info')->nullable();
            $table->longText('campaign_purpose')->nullable();

            $table->string('min_reach')->nullable();
            $table->json('states')->nullable();
            $table->json('line_of_business');
            $table->json('category')->nullable();
            $table->json('social_media')->nullable();
            $table->string('type');


            $table->boolean('private')->default(0);
            $table->boolean('ended')->default(0);
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
