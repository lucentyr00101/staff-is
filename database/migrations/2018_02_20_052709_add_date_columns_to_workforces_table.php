<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDateColumnsToWorkforcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workforces', function (Blueprint $table) {
            $table->string('work_schedule_start_date')->after('work_type');
            $table->string('work_schedule_end_date')->after('work_schedule_start');
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
            $table->dropColumn('work_schedule_start_date');
            $table->dropColumn('work_schedule_end_date');
        });
    }
}
