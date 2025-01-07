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
        Schema::create('package_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('contact');
            $table->text('description_one');
            $table->text('description_two');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('package_contacts');
    }
};