<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->string('location');
            $table->decimal('salary_range', 10, 2)->nullable();
            $table->string('image')->nullable();
            $table->text('requirements')->nullable();
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('admin_id')->nullable(); // Admin ID column
            $table->date('closing_date');
            $table->dateTime('approved_date')->nullable(); // Approved date column
            $table->dateTime('rejected_date')->nullable();
            $table->string('status')->default('pending'); // Status column
            $table->string('rejection_reason')->nullable(); // Rejection reason column
            $table->string('job_id')->index(); // Job ID column (required)
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
            $table->foreign('employer_id')->references('id')->on('employers');
            $table->foreign('admin_id')->references('id')->on('admins'); // Admin foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};