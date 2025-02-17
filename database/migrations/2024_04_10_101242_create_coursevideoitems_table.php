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
        Schema::create('coursevideoitems', function (Blueprint $table) {
            $table->id();
            $table->integer('course_video_id');
            $table->integer('course_id');
            $table->string('title');
            $table->string('duration');
            $table->string('video');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coursevideoitems');
    }
};
