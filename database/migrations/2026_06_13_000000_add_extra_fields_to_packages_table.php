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
        Schema::table('packages', function (Blueprint $table) {
            $table->string('makkah_hotel')->nullable()->after('star_rating');
            $table->string('madinah_hotel')->nullable()->after('makkah_hotel');
            $table->string('status')->nullable()->default('Available')->after('featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['makkah_hotel', 'madinah_hotel', 'status']);
        });
    }
};
