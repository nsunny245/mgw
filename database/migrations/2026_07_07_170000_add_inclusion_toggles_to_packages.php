<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->boolean('include_flights')->default(true)->after('featured');
            $table->boolean('include_hotels')->default(true)->after('include_flights');
            $table->boolean('include_transport')->default(true)->after('include_hotels');
        });
    }

    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['include_flights', 'include_hotels', 'include_transport']);
        });
    }
};
