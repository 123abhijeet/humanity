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
        Schema::create('studymaterials', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->integer('course_category');
            $table->integer('course_subcategory');
            $table->integer('course');
            $table->integer('type');
            $table->string('title');
            $table->string('subject');
            $table->integer('total_chapters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studymaterials');
    }
};
