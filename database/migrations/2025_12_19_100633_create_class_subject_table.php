<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_subject', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
=======
            $table->foreignId('class_model_id')->constrained('classes')->onDelete('cascade');
>>>>>>> julius2
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('set null');
            $table->timestamps();
            
            // Ensure unique combination of class and subject
<<<<<<< HEAD
            $table->unique(['class_id', 'subject_id']);
=======
            $table->unique(['class_model_id', 'subject_id']);
>>>>>>> julius2
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_subject');
    }
}
