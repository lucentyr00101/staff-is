<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workforce_id')->unsigned()->nullable();
            $table->foreign('workforce_id')->references('id')->on('workforces')->onDelete('cascade');
            $table->string('schedule_date')->nullable();
            $table->string('schedule_time_in')->nullable();
            $table->string('schedule_time_out')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_schedules');
    }
}
