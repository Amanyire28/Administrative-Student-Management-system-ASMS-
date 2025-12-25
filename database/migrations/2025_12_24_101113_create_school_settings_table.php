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
        Schema::create('school_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->index(); // e.g., 'school_name', 'school_logo'
            $table->text('value')->nullable(); // The actual value or JSON data
            $table->string('type')->default('text'); // 'text', 'image', 'json', 'integer', 'boolean'
            $table->string('group')->index(); // 'basic', 'contact', 'academic', 'email', 'report'
            $table->text('description')->nullable(); // Optional: describe what this setting does
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_settings');
    }
};
