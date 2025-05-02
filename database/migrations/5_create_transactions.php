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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key for user
            $table->string('name'); // Name of the transaction
            $table->text('description')->nullable(); // Description of the transaction (nullable)
            $table->enum('recurrence', ['once', 'daily', 'weekly', 'monthly', 'yearly']); // Enum for recurrence
            $table->date('date')->nullable();
            $table->foreign('date')->references('date')->on('dates')->onDelete('set null'); // The date of the transaction
            $table->boolean('is_item')->default(false); // Boolean flag for is_item
            $table->decimal('total', 10, 2); // Total amount of the transaction
            $table->boolean('active')->default(true); // Default active status is true
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
