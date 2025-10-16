<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            // Only add the column if it doesn't exist
            if (!Schema::hasColumn('schedules', 'color')) {
                $table->string('color')->nullable()->after('title');
            }
        });
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            if (Schema::hasColumn('schedules', 'color')) {
                $table->dropColumn('color');
            }
        });
    }
};
