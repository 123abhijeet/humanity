<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id', 'course_category', 'course_subcategory', 'course','title', 'subject', 'total_questions', 'total_time', 'type', 'level'];
}
