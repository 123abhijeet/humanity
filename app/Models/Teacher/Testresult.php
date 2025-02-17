<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testresult extends Model
{
    use HasFactory;
    protected $fillable = ['test_id','student_id','total_question','time_taken','total_right','total_wrong','total_score'];
}
