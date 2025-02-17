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
        Schema::create('coursevideos', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->integer('course_category');
            $table->integer('course_subcategory');
            $table->integer('course');
            $table->string('section');
            $table->integer('total_videos');
            $table->string('total_duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coursevideos');
    }
};
