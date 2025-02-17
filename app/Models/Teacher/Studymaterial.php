<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studymaterial extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id','course_category','course_subcategory','course','type','title','subject','total_chapters'];
}
