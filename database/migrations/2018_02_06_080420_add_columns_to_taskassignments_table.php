<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToTaskassignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('taskassignments', function (Blueprint $table) {
            $table->boolean('is_approved_by_admin')->default(0)->after('is_read');
            $table->boolean('is_read_by_admin')->default(0)->after('is_approved_by_admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taskassignments', function (Blueprint $table) {
            $table->dropColumn('is_approved_by_admin');
            $table->dropColumn('is_read_by_admin');
        });
    }
}
