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
            $table->unsignedBigInteger('employer_id')->nullable(); // Nullable for external jobs
            $table->unsignedBigInteger('admin_id')->nullable(); // Nullable for non-admin edits
            $table->unsignedBigInteger('creator_id'); // Admin who created the posting
            $table->date('closing_date');
            $table->dateTime('approved_date')->nullable();
            $table->dateTime('rejected_date')->nullable();
            $table->string('status')->default('pending');
            $table->string('rejection_reason')->nullable();
            $table->string('job_id')->index();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('set null');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('creator_id')->references('id')->on('admins')->onDelete('cascade');
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