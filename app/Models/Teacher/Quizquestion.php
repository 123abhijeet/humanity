<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quizquestion extends Model
{
    use HasFactory;
    protected $fillable = ['quiz_id','question','option_a','option_b','option_c','option_d','answer'];
}
