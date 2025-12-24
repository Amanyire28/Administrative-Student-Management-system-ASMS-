<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Auto-generated from class_level + stream
            $table->unsignedBigInteger('class_level_id')->nullable();
            $table->unsignedBigInteger('stream_id')->nullable();
            $table->integer('capacity')->default(30); // Maximum number of students
            $table->string('classroom')->nullable(); // Room number or location
            $table->unsignedBigInteger('class_teacher_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('class_level_id')->references('id')->on('class_levels')->onDelete('cascade');
            $table->foreign('stream_id')->references('id')->on('streams')->onDelete('cascade');
            $table->foreign('class_teacher_id')->references('id')->on('teachers')->onDelete('set null');

            // Unique constraint for class_level + stream combination
            $table->unique(['class_level_id', 'stream_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
