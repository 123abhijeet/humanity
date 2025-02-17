<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coursevideo extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id', 'course_category', 'course_subcategory', 'course','section','total_videos','total_duration'];
}
