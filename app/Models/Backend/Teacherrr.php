<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacherrr extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id','student_id','review','rating','status'];
}
