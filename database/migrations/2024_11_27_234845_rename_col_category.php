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
        Schema::table('category', function (Blueprint $table) {
            // Rename the 'name' column to 'title' in the 'categories' table
            $table->renameColumn('sub_category', 'parent_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
