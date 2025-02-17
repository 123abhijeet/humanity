<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_category', 'course_subcategory', 'course_id', 'quiz_id', 'offer_type', 'offer_title',
        'offer_code', 'offer_value', 'start_date', 'end_date', 'offer_banner','status'
    ];
}
