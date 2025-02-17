<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjectivetestresult extends Model
{
    use HasFactory;
    protected $fillable = ['test_id','student_id','total_question','time_taken','total_score'];
}
