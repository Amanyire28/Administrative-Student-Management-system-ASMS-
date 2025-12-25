<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create class categories table first
        Schema::create('class_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., "Pre-Primary", "Primary", "Secondary"
            $table->string('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Create class levels table
        Schema::create('class_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., "Primary 1", "Nursery", "A-Level 1"
            $table->unsignedBigInteger('category_id')->nullable(); // Reference to class_categories
            $table->integer('sort_order')->default(0); // For ordering levels
            $table->unsignedBigInteger('level_teacher_id')->nullable(); // Class level teacher
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('category_id')->references('id')->on('class_categories')->onDelete('set null');
            $table->foreign('level_teacher_id')->references('id')->on('teachers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_levels');
        Schema::dropIfExists('class_categories');
    }
}