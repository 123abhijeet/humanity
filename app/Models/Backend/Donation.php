<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = ['donors_name', 'donors_age', 'donors_mobile', 'donors_address', 'donors_blood_group', 'donors_last_donation_date', 'vanue_name', 'vanue_address', 'donation_date'];
}
