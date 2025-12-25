<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique(); // e.g., "STU2025001"
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('parent_email')->nullable();
<<<<<<< HEAD
            $table->foreignId('class_id')->nullable()->constrained('classes')->onDelete('set null');
=======
            $table->unsignedBigInteger('class_id')->nullable();
>>>>>>> julius2
            $table->date('enrollment_date');
            $table->string('photo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
<<<<<<< HEAD
=======

            // Foreign key constraint
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null');
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
        Schema::dropIfExists('students');
    }
}
