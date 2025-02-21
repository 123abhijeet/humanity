<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloodrequest extends Model
{
    use HasFactory;    
    protected $fillable = ['patent_name', 'patent_age', 'patent_address', 'patent_problem', 'patent_blood_group', 'unit_required', 'hospital_name', 'hospital_address', 'date_required','attendent_name','attendent_mobile','donated_unit'];
}
