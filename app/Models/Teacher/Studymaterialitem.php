<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studymaterialitem extends Model
{
    use HasFactory;
    protected $fillable = ['studymaterial_id', 'course', 'type', 'chapter', 'pdf'];
}
