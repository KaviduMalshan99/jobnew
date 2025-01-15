<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchNameToBankAccountsTable extends Migration
{
    public function up()
    {
        Schema::table('bank_accounts', function (Blueprint $table) {
            $table->string('branch_name')->after('branch_code');
        });
    }

    public function down()
    {
        Schema::table('bank_accounts', function (Blueprint $table) {
            $table->dropColumn('branch_name');
        });
    }
}
