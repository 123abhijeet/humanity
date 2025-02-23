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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_no');
            $table->string('donors_name');
            $table->string('donors_age');
            $table->string('donors_mobile');
            $table->string('donors_address');
            $table->string('donors_blood_group');
            $table->string('donors_last_donation_date')->nullable();
            $table->string('vanue_name');
            $table->string('vanue_address');
            $table->string('donation_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
