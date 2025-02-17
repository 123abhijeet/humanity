<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coursevideoitem extends Model
{
    use HasFactory;
    protected $fillable = ['course_video_id','course_id', 'title', 'duration', 'video'];
}
