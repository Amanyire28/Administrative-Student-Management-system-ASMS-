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
        // Create class_levels table
        Schema::create('class_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., "P1", "S1", "Baby"
            $table->unsignedBigInteger('school_type_id'); // Foreign key to school_types
            $table->integer('sort_order')->default(0); // For ordering levels within a school type
            $table->unsignedBigInteger('level_teacher_id')->nullable(); // Class level teacher
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('school_type_id')->references('id')->on('school_types')->onDelete('cascade');
            $table->foreign('level_teacher_id')->references('id')->on('teachers')->onDelete('set null');
            
            // Unique constraint to prevent duplicate class names within the same school type
            $table->unique(['name', 'school_type_id']);
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
    }
}