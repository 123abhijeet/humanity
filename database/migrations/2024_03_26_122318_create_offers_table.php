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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->integer('course_category');
            $table->integer('course_subcategory');
            $table->integer('course_id')->nullable();
            $table->integer('quiz_id')->nullable();
            $table->string('offer_type');
            $table->string('offer_title');
            $table->string('offer_code')->unique();
            $table->string('offer_value');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('offer_banner');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
