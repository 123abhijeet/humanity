<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emipayment extends Model
{
    use HasFactory;
    protected $fillable = ['course_payment_id', 'transaction_id', 'paid_amount', 'due_amount', 'due_date','payment_status'];
}
