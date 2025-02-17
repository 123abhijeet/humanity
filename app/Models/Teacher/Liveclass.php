<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liveclass extends Model
{
    use HasFactory;
    protected $fillable = ['course_category', 'course_subcategory', 'course_id', 'teacher_id', 'title','meeting_id', 'join_url', 'duration', 'password', 'start_time'];
}
