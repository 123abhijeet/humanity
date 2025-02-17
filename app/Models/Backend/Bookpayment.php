<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookpayment extends Model
{
    use HasFactory;
    protected $fillable = ['book_id','student_id','order_no','transaction_id','amount','payment_status','name','email','mobile','address','tracking_detail'];
}
