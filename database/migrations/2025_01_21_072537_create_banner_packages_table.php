<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banner_packages', function (Blueprint $table) {
            $table->id();
            $table->enum('duration', ['7days', '21days']) // Duration of the package
                ->comment('Specifies the duration of the banner package: 7days or 21days');
            $table->decimal('price_lkr', 10, 2); // Price in LKR
            $table->decimal('price_usd', 10, 2); // Price in USD
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('banner_packages');
    }
};