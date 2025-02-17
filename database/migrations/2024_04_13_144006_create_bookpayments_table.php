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
        Schema::create('bookpayments', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id');
            $table->integer('student_id');
            $table->string('order_no');
            $table->string('transaction_id');
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->string('address');
            $table->string('amount');
            $table->string('payment_status');
            $table->string('tracking_detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookpayments');
    }
};
