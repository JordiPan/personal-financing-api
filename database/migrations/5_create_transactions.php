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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name'); 
            $table->text('description')->nullable();
            $table->enum('recurrence', ['once', 'daily', 'weekly', 'monthly', 'yearly']);
            $table->date('date');
            $table->foreign('date')->references('date')->on('dates')->onDelete('set null');
            $table->decimal('total', 10, 2); 
            $table->boolean('active')->default(true);
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
