<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_education', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('job_seeker_id'); // Foreign key
            $table->string('institution_name', 255);
            $table->string('degree', 255);
            $table->string('field_of_study', 255);
            $table->date('start_date');
            $table->date('end_date')->nullable(); // NULL if still studying
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('job_seeker_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_education');
    }
};