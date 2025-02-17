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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->integer('course_category');
            $table->integer('course_subcategory');
            $table->integer('course');
            $table->string('title');
            $table->string('subject');
            $table->integer('total_questions');
            $table->string('total_time');
            $table->string('type');
            $table->string('level');
            $table->string('price')->nullable();
            $table->string('attempt_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
