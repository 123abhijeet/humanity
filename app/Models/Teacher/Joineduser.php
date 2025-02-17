<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joineduser extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','channel_name'];
}
