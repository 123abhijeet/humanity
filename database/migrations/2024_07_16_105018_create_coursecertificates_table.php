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
        Schema::create('coursecertificates', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_no');
            $table->integer('student_id');
            $table->integer('teacher_id');
            $table->integer('course_id');
            $table->string('course_start_date');
            $table->string('course_end_date');
            $table->string('course_issued_date');
            $table->string('certificate_issued_date');
            $table->string('certificate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coursecertificates');
    }
};
