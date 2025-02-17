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
        Schema::create('quiz_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_id');
            $table->integer('student_id');
            $table->string('transaction_id');
            $table->string('name');
            $table->string('email');
            $table->string('amount');
            $table->string('coupon_code')->nullable();
            $table->string('coupon_amount')->nullable();
            $table->string('discounted_amount')->nullable();
            $table->string('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_payments');
    }
};
