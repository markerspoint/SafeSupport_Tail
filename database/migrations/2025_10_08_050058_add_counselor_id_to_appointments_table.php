<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCounselorIdToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('counselor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('counselor_name')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['counselor_id']);
            $table->dropColumn('counselor_id');
            $table->string('counselor_name')->change();
        });
    }
}