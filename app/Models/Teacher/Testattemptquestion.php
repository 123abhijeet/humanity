<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testattemptquestion extends Model
{
    use HasFactory;
    protected $fillable = ['test_id', 'student_id', 'question_id', 'question', 'option_a', 'option_b', 'option_c', 'option_d', 'answer', 'right_answer'];
}
