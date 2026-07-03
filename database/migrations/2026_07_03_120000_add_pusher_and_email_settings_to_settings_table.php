<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('notification_emails')->nullable()->after('email');
            $table->string('pusher_app_id')->nullable();
            $table->string('pusher_app_key')->nullable();
            $table->string('pusher_app_secret')->nullable();
            $table->string('pusher_app_cluster')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'notification_emails',
                'pusher_app_id',
                'pusher_app_key',
                'pusher_app_secret',
                'pusher_app_cluster'
            ]);
        });
    }
};
