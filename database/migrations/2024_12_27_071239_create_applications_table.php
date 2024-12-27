<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Applicant Name
            $table->string('email'); // Applicant Email
            $table->string('contact_number'); // Contact Number
            $table->text('message')->nullable(); // Message (optional)
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign Key for User
            $table->unsignedBigInteger('employer_id'); // Foreign Key for Employer
            $table->string('company_mail'); // Employer's Email
            $table->string('cv_path')->nullable(); // Path to uploaded CV
            $table->timestamps(); // Created and Updated timestamps

            // Foreign Key Constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
