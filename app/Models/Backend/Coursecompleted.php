<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coursecompleted extends Model
{
    use HasFactory;
    protected $fillable = ['student_id','teacher_id','course_id','course_start_date','course_end_date'];
}
