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
        Schema::table('banners', function (Blueprint $table) {
            $table->text('rejection_reason')->nullable()->after('placement')
                ->comment('Stores the reason for rejection if banner is rejected');

            $table->foreignId('admin_id')->nullable()->after('rejection_reason')
                ->constrained('users')
                ->nullOnDelete()
                ->comment('ID of the admin who last updated the banner status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn(['rejection_reason', 'admin_id']);
        });
    }
};