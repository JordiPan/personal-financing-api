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
            $table->string('name'); 
            $table->text('description');
            $table->decimal('price', 10, 2); 
            $table->foreignId('country_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('transaction_id')->nullable()->constrained()->onDelete('set null'); 
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('img_link')->nullable();
            $table->string('tcg_api_id')->nullable();
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
