<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->string('term'); // e.g., "Term 1", "Semester 1"
            $table->string('academic_year'); // e.g., "2025-2026"
            $table->decimal('marks_obtained', 5, 2); // e.g., 85.50
            $table->decimal('total_marks', 5, 2)->default(100.00);
            $table->string('grade')->nullable(); // e.g., "A", "B+", "C"
            $table->text('remarks')->nullable();
            $table->timestamps();
            
            // Ensure unique combination per student, subject, term, and academic year
            $table->unique(['student_id', 'subject_id', 'term', 'academic_year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marks');
    }
}
