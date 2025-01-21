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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Banner title
            $table->text('description')->nullable(); // Banner description
            $table->string('image'); // Banner image path
            $table->foreignId('category_id')->nullable() // Nullable category ID
                ->constrained('categories') // References the categories table
                ->nullOnDelete(); // Set to null on category deletion
            $table->foreignId('package_id') // Package ID
                ->constrained('banner_packages') // References the banner_packages table
                ->cascadeOnDelete(); // Delete banner if package is deleted
            $table->string('payment_method')->nullable() // Payment method
                ->comment('Stores the payment method: online, contact_contributor');
            $table->enum('placement', ['banner', 'category_page']) // Placement type
                ->default('banner')
                ->comment('Indicates if the banner is for the main banner or category page');
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};