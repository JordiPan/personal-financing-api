<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID field
            $table->string('first_name'); // For first name
            $table->string('last_name');  // For last name
            $table->date('birthdate');    // For birthdate
            $table->string('email')->unique(); // For email with unique constraint
            $table->string('password');   // For password
            $table->enum('role', ['user', 'admin', 'moderator'])->default('user'); 
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
