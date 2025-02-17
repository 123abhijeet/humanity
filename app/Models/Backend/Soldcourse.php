<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soldcourse extends Model
{
    use HasFactory;
    protected $fillable = ['course_id','teacher_id','student_id'];
}
