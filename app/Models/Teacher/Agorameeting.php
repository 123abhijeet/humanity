<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agorameeting extends Model
{
    use HasFactory;
    protected $fillable = ['course_category', 'course_subcategory', 'course_id', 'teacher_id', 'title', 'agora_channel', 'start_time', 'end_time', 'duration'];
}
