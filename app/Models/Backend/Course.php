<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['course_uid','teacher_id','course_category','course_subcategory','course_name','course_fee','subject','course_duration','course_short_description','course_description','level','course_banner','course_video','status'];

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }
}
