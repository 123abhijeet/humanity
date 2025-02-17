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
        Schema::create('agorameetings', function (Blueprint $table) {
            $table->id();
            $table->integer('course_category');
            $table->integer('course_subcategory');
            $table->integer('course_id');
            $table->integer('teacher_id');
            $table->string('title');
            $table->string('agora_channel')->unique();
            $table->string('start_time');
            $table->string('end_time');
            $table->string('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agorameetings');
    }
};
