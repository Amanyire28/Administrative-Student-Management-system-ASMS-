<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TeacherPivotTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, ensure all referenced tables exist
        if (!Schema::hasTable('teachers')) {
            throw new \Exception('Teachers table must be created first! Run the CreateTeachersTableFirst migration.');
        }

        if (!Schema::hasTable('class_streams')) {
            throw new \Exception('Class streams table does not exist');
        }

        if (!Schema::hasTable('subjects')) {
            throw new \Exception('Subjects table does not exist');
        }

        // Create class_stream_teacher table
        if (!Schema::hasTable('class_stream_teacher')) {
            Schema::create('class_stream_teacher', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('teacher_id');
                $table->unsignedBigInteger('class_stream_id');
                $table->boolean('is_class_teacher')->default(false);
                $table->timestamps();

                $table->unique(['teacher_id', 'class_stream_id']);
                $table->index(['teacher_id', 'is_class_teacher']);
            });

            // Add foreign keys separately
            Schema::table('class_stream_teacher', function (Blueprint $table) {
                $table->foreign('teacher_id')
                      ->references('id')
                      ->on('teachers')
                      ->onDelete('cascade');

                $table->foreign('class_stream_id')
                      ->references('id')
                      ->on('class_streams')
                      ->onDelete('cascade');
            });
        }

        // Create teacher_subject table
        if (!Schema::hasTable('teacher_subject')) {
            Schema::create('teacher_subject', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('teacher_id');
                $table->unsignedBigInteger('subject_id');
                $table->timestamps();

                $table->unique(['teacher_id', 'subject_id']);
            });

            // Add foreign keys separately
            Schema::table('teacher_subject', function (Blueprint $table) {
                $table->foreign('teacher_id')
                      ->references('id')
                      ->on('teachers')
                      ->onDelete('cascade');

                $table->foreign('subject_id')
                      ->references('id')
                      ->on('subjects')
                      ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('teacher_subject');
        Schema::dropIfExists('class_stream_teacher');
    }

}
