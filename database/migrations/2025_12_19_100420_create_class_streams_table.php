<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_streams', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Auto-generated from class + stream
            $table->unsignedBigInteger('class_level_id'); // Reference to class_levels table
            $table->unsignedBigInteger('stream_id')->nullable();
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
        Schema::dropIfExists('class_streams');
    }
}