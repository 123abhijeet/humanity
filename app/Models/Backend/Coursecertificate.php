<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coursecertificate extends Model
{
    use HasFactory;
    protected $fillable = ['certificate_no', 'student_id', 'teacher_id', 'course_id', 'course_start_date', 'course_end_date', 'course_issued_date', 'certificate_issued_date','certificate'];
}
