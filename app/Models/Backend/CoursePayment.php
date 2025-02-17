<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePayment extends Model
{
    use HasFactory;
    protected $fillable = ['course_id', 'student_id', 'teacher_id','transaction_id', 'name', 'email', 'amount','payment_type','installment_amount', 'due_date','due_amount', 'coupon_code','coupon_amount','discounted_amount','payment_status','payment_receipt'];
}
