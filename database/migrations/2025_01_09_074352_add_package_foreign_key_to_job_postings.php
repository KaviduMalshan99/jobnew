<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPackageForeignKeyToJobPostings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_postings', function (Blueprint $table) {
            // Add package_id column if it doesn't exist
            if (!Schema::hasColumn('job_postings', 'package_id')) {
                $table->unsignedBigInteger('package_id')->nullable();
            }

            // Add foreign key constraint
            $table->foreign('package_id')
                ->references('id')
                ->on('packages')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_postings', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['package_id']);

            // Optionally drop the column
            // $table->dropColumn('package_id');
        });
    }
}