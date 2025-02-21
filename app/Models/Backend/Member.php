<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = ['members_name', 'members_age', 'members_mobile', 'members_address', 'members_blood_group', 'members_last_donation_date'];
}
