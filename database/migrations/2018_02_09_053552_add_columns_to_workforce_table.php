<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToWorkforceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workforces', function (Blueprint $table) {
            $table->time('work_schedule_start')->nullable()->after('work_type');
            $table->time('work_schedule_end')->nullable()->after('work_schedule_start');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workforces', function (Blueprint $table) {
            $table->dropColumn('work_schedule_start');
            $table->dropColumn('work_schedule_end');
        });
    }
}
