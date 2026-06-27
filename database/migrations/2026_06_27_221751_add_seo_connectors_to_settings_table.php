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
            $table->string('google_analytics_id')->nullable()->after('whatsapp_number');
            $table->string('google_tag_manager_id')->nullable()->after('google_analytics_id');
            $table->text('google_search_console_meta')->nullable()->after('google_tag_manager_id');
            $table->text('custom_head_scripts')->nullable()->after('google_search_console_meta');
            $table->text('custom_body_scripts')->nullable()->after('custom_head_scripts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'google_analytics_id',
                'google_tag_manager_id',
                'google_search_console_meta',
                'custom_head_scripts',
                'custom_body_scripts',
            ]);
        });
    }
};
