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
        Schema::create('teachernotifiys', function (Blueprint $table) {
            $table->id();
            $table->integer('course_category');
            $table->integer('course_subcategory');
            $table->integer('course');
            $table->string('message');
            $table->string('attachment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachernotifiys');
    }
};
