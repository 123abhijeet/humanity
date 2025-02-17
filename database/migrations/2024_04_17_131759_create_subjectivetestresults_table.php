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
        Schema::create('subjectivetestresults', function (Blueprint $table) {
            $table->id();
            $table->integer('test_id');
            $table->integer('student_id');
            $table->integer('total_question');
            $table->string('time_taken');
            $table->string('total_right')->nullable();
            $table->string('total_wrong')->nullable();
            $table->string('total_score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjectivetestresults');
    }
};
