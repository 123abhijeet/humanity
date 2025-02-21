<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\UserRegistered;
use App\Models\Backend\Bloodrequest;
use App\Models\Backend\Book;
use App\Models\Backend\Category;
use App\Models\Backend\Contact;
use App\Models\Backend\Course;
use App\Models\Backend\CoursePayment;
use App\Models\Backend\Donation;
use App\Models\Backend\Member;
use App\Models\Backend\Student;
use App\Models\Backend\Subcategory;
use App\Models\Backend\Teacher;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }
    public function events()
    {
        return view('frontend.events');
    }
    public function donate_blood()
    {
        return view('frontend.donate_blood');
    }
    public function request_blood()
    {
        return view('frontend.request_blood');
    }
    public function become_member()
    {
        return view('frontend.become_member');
    }

    public function store_blood_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patent_name' => ['required'],
            'patent_age' => ['required'],
            'patent_address' => ['required'],
            'patent_problem' => ['required'],
            'patent_blood_group' => ['required'],
            'unit_required' => ['required'],
            'hospital_name' => ['required'],
            'hospital_address' => ['required'],
            'date_required' => ['required'],
            'attendent_name' => ['required'],
            'attendent_mobile' => ['required'],
            'donated_unit' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        Bloodrequest::create($data);
        return redirect()->back()->with('success', 'Your details submitted successfully');
    }
    public function store_blood_donation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'donors_name' => ['required'],
            'donors_age' => ['required'],
            'donors_mobile' => ['required'],
            'donors_address' => ['required'],
            'donors_blood_group' => ['required'],
            'donors_last_donation_date' => [],
            'vanue_name' => ['required'],
            'vanue_address' => ['required'],
            'donation_date' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        Donation::create($data);
        return redirect()->back()->with('success', 'Your details submitted successfully');
    }
    public function store_member(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'members_name' => ['required'],
            'members_age' => ['required'],
            'members_mobile' => ['required'],
            'members_address' => ['required'],
            'members_blood_group' => ['required'],
            'members_last_donation_date' => [],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        Member::create($data);
        return redirect()->back()->with('success', 'Your details submitted successfully');
    }
    
    public function privacy_policy()
    {
        return view('frontend.policies.privacy_policy');
    }
    public function terms()
    {
        return view('frontend.policies.term_conditions');
    }
}
