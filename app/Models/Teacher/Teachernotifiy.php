<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachernotifiy extends Model
{
    use HasFactory;
    protected $fillable = ['course_category','course_subcategory','course','message','attachment'];
}
