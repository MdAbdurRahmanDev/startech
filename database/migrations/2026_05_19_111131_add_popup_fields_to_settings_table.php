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
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('popup_enabled')->default(true);
            $table->string('popup_title')->nullable();
            $table->text('popup_description')->nullable();
            $table->string('popup_google_play_url')->nullable();
            $table->string('popup_app_store_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'popup_enabled',
                'popup_title',
                'popup_description',
                'popup_google_play_url',
                'popup_app_store_url',
            ]);
        });
    }
};
