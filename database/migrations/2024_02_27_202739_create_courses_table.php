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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->integer('course_category');
            $table->integer('course_subcategory');
            $table->string('course_uid');
            $table->string('course_name');
            $table->string('course_fee');
            $table->string('subject');
            $table->string('level');
            $table->string('course_duration');
            $table->string('course_short_description');
            $table->longText('course_description');
            $table->string('course_banner');
            $table->string('course_video');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
