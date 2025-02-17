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
        Schema::create('quizresults', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_id');
            $table->integer('student_id');
            $table->integer('total_question');
            $table->string('time_taken');
            $table->string('total_right');
            $table->string('total_wrong');
            $table->string('total_score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizresults');
    }
};
