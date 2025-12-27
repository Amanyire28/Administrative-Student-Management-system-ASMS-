<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      public function up()
    {
        // Create teachers table if it doesn't exist
        if (!Schema::hasTable('teachers')) {
            Schema::create('teachers', function (Blueprint $table) {
                $table->id();
                $table->string('employee_id')->unique();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('other_names')->nullable();
                $table->string('email')->unique();
                $table->string('phone')->nullable();
                $table->date('date_of_birth')->nullable();
                $table->enum('gender', ['male', 'female', 'other'])->nullable();
                $table->text('address')->nullable();
                $table->string('national_id')->nullable()->unique();
                $table->text('qualifications')->nullable();
                $table->date('employment_date');
                $table->string('designation')->nullable();
                $table->string('photo')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
                $table->softDeletes();

                // Indexes
                $table->index(['first_name', 'last_name']);
                $table->index('employee_id');
                $table->index('is_active');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Don't drop teachers table to preserve data
        Schema::dropIfExists('teachers');
    }

}
