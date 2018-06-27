<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreColumnsToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('company_address')->nullable()->after('id_number');
            $table->string('company_state')->nullable()->after('company_address');
            $table->string('company_country')->nullable()->after('company_state');
            $table->string('company_zip_code')->nullable()->after('company_country');

            $table->string('branch_address')->nullable()->after('company_zip_code');
            $table->string('branch_state')->nullable()->after('branch_address');
            $table->string('branch_country')->nullable()->after('branch_state');
            $table->string('branch_zip_code')->nullable()->after('branch_country');
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
            $table->dropColumn('company_address');
            $table->dropColumn('company_state');
            $table->dropColumn('company_country');
            $table->dropColumn('company_zip_code');

            $table->dropColumn('branch_address');
            $table->dropColumn('branch_state');
            $table->dropColumn('branch_country');
            $table->dropColumn('branch_zip_code');
        });
    }
}
