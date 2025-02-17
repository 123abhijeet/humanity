<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizPayment extends Model
{
    use HasFactory;
    protected $fillable = ['quiz_id', 'student_id', 'transaction_id', 'name', 'email', 'amount','coupon_code','coupon_amount','discounted_amount', 'payment_status'];
}
