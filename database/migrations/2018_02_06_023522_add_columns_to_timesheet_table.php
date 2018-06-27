<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToTimesheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timesheets', function (Blueprint $table) {
            $table->string('date')->nullable()->after('work_hours');
            $table->string('code')->nullable()->after('date');
            $table->string('job_description')->nullable()->after('code');
            $table->time('time_in')->nullable()->after('job_description');
            $table->time('time_out')->nullable()->after('time_in');
            $table->string('reg_time')->nullable()->after('time_out');
            $table->string('overtime')->nullable()->after('reg_time');
            $table->text('remarks_from_emp')->nullable()->after('overtime');
            $table->text('remarks_from_company')->nullable()->after('remarks_from_emp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timesheets', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('code');
            $table->dropColumn('job_description');
            $table->dropColumn('time_in');
            $table->dropColumn('time_out');
            $table->dropColumn('reg_time');
            $table->dropColumn('overtime');
            $table->dropColumn('remarks_from_emp');
            $table->dropColumn('remarks_from_company');
        });
    }
}
