<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacherscoursepayment extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id','student_id','course_id','commission','payment_status','payment_type','payment_proof','due_date'];
}
