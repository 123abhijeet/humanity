<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\BloodRequestEmail;
use App\Models\Backend\Bloodrequest;
use App\Models\Backend\Donation;
use App\Models\Backend\Member;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
        $user_detail = User::get();
        foreach ($user_detail as $item) {
            try {
                Mail::to($item->email)->send(new BloodRequestEmail($item->name,$item->email,$data['attendent_name'],$data['attendent_mobile'],$data['patent_blood_group'],$data['unit_required'],$data['hospital_name'],$data['hospital_address']));
            } catch (Exception $exception) {
                \Log::error('Mail sending error: ' . $exception->getMessage());
            }
        }
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

    public function update_last_donation_date(Request $request)
    {
        Member::where('id',$request->member_id)->update([
            'members_last_donation_date' => $request->members_last_donation_date
        ]);
        return redirect()->back()->with('success', 'Last donation date updated successfully');
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
