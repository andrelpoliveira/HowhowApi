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
        Schema::create('cpms', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->references('id')->on('users');
            $table->string('yt_vd_insertion')->nullable();
            $table->string('yt_vd_dedicated')->nullable();
            $table->string('yt_repost')->nullable();
            $table->string('yt_post_community')->nullable();
            $table->string('yt_short')->nullable();
            $table->string('yt_sh_insertion')->nullable();
            $table->string('yt_live')->nullable();
            $table->string('yt_presential')->nullable();
            $table->string('ist_combo')->nullable();
            $table->string('ist_insertion')->nullable();
            $table->string('ist_vd_dedicated')->nullable();
            $table->string('ist_post')->nullable();
            $table->string('ist_repost')->nullable();
            $table->string('ist_live')->nullable();
            $table->string('fb_combo')->nullable();
            $table->string('fb_post_feed')->nullable();
            $table->string('fb_vd_dedicated')->nullable();
            $table->string('fb_repost')->nullable();
            $table->string('fb_story')->nullable();
            $table->string('fb_live')->nullable();
            $table->string('tw_retweet')->nullable();
            $table->string('tw_post')->nullable();
            $table->string('kw_insertion')->nullable();
            $table->string('kw_vd_insertion')->nullable();
            $table->string('kw_repost')->nullable();
            $table->string('kw_live')->nullable();
            $table->string('tk_insertion')->nullable();
            $table->string('tk_vd_dedicated')->nullable();
            $table->string('tk_repost')->nullable();
            $table->string('tk_live')->nullable();
            $table->string('tk_impulse')->nullable();
            $table->string('tk_selectedRadio')->nullable();
            $table->string('hw_remarketing')->nullable();
            $table->string('hw_link_bio')->nullable();
            $table->string('hw_link_description')->nullable();
            $table->string('hw_link_comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpm');
    }
};
