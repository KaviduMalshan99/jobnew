<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->change(); // Make user_id nullable
        });
    }

    public function down(): void
    {
        Schema::table('feedback', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->change(); // Revert user_id to not nullable
        });
    }
};