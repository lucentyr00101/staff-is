<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBankingInformationColumnsToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('account_number')->nullable()->after('emergency_contact_number');
            $table->string('bank_name')->nullable()->after('account_number');
            $table->string('type_of_account')->nullable()->after('bank_name');
            $table->text('bank_information')->nullable()->after('type_of_account');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('account_number');
            $table->dropColumn('bank_name');
            $table->dropColumn('type_of_account');
            $table->dropColumn('bank_information');
        });
    }
}
