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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // For the item name
            $table->text('description'); // For the item description
            $table->decimal('price', 10, 2); // For the price with 2 decimal places
            $table->integer('amount'); // For the amount of items available
            $table->foreignId('country_id')->constrained()->onDelete('cascade'); // Foreign key referencing countries table
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Foreign key referencing categories table
            $table->foreignId('transaction_id')->nullable()->constrained()->onDelete('set null'); // Foreign key for transactions (nullable)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key referencing users table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
