<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeveralColumnsToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('department')->nullable()->after('fullname');
            $table->string('id_number')->nullable()->after('department');
            $table->string('company_address')->nullable()->after('id_number');
            $table->string('branch_address')->nullable()->after('company_address');
            $table->string('mobile_number')->nullable()->after('branch_address');
            $table->string('telephone_number')->nullable()->after('mobile_number');
            $table->string('email_address')->nullable()->after('telephone_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('department');
            $table->dropColumn('id_number');
            $table->dropColumn('company_address');
            $table->dropColumn('branch_address');
            $table->dropColumn('mobile_number');
            $table->dropColumn('telephone_number');
            $table->dropColumn('email_address');
        });
    }
}
