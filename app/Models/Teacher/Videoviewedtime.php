<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videoviewedtime extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'course_video_id', 'video_id', 'viewed_time'];
}
