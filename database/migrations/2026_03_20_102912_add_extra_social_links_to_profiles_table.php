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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('whatsapp_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['instagram_url', 'youtube_url', 'facebook_url', 'whatsapp_number']);
        });
    }
};
