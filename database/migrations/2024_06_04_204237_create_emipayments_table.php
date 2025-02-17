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
        Schema::create('emipayments', function (Blueprint $table) {
            $table->id();
            $table->integer('course_payment_id');
            $table->string('transaction_id');
            $table->string('paid_amount');
            $table->string('due_amount');
            $table->string('due_date');
            $table->string('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emipayments');
    }
};
