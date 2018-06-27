<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('fullname')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('number_of_children')->nullable();
            $table->string('nationality')->nullable();
            $table->boolean('hasDriverLicense')->default('0');
            $table->boolean('hasCar')->default('0');
            $table->text('address')->nullable();
            $table->text('summary')->nullable();
            $table->string('email_confirmation')->nullable();
            $table->string('emergency_contact_number')->nullable();
            
            $table->timestamps();
        });

        // Schema::table('employees', function (Blueprint $table) {
            
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
