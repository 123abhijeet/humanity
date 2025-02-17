<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminnotifiy extends Model
{
    use HasFactory;
    protected $fillable = ['message','attachment'];
}
