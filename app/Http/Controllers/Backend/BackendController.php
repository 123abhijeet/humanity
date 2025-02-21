<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Bloodrequest;
use App\Models\Backend\Contact;
use App\Models\Backend\Donation;
use App\Models\Backend\Member;
use App\Models\Backend\Student;
use App\Models\Backend\Teacher;
use App\Models\Teacher\Liveclass;
use App\Models\Teacher\Quizresult;
use App\Models\Teacher\Subjectivetestresult;
use App\Models\Teacher\Testattemptquestion;
use App\Models\Teacher\Testresult;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    public function index()
    {
        $total_members = Member::count();
        $total_requests = Bloodrequest::count();
        $total_donations = Donation::count();
        $totalApositive = Donation::where('donors_blood_group', 'A+')->count();
        $totalAnegative = Donation::where('donors_blood_group', 'A-')->count();
        $totalBpositive = Donation::where('donors_blood_group', 'B+')->count();
        $totalBnegative = Donation::where('donors_blood_group', 'B-')->count();
        $totalOpositive = Donation::where('donors_blood_group', 'O+')->count();
        $totalOnegative = Donation::where('donors_blood_group', 'O-')->count();
        $totalABpositive = Donation::where('donors_blood_group', 'AB+')->count();
        $totalABnegative = Donation::where('donors_blood_group', 'AB-')->count();
        $totalBombay = Donation::where('donors_blood_group', 'Bombay')->count();
        $donors = Donation::orderBy('id', 'desc')->get();
        $members = Member::orderBy('id', 'desc')->get();
        return view('backend.index', compact(
            'total_members',
            'total_requests',
            'total_donations',
            'totalApositive',
            'totalAnegative',
            'totalBpositive',
            'totalBnegative',
            'totalOpositive',
            'totalOnegative',
            'totalABpositive',
            'totalABnegative',
            'totalBombay',
            'donors',
            'members'
        ));
    }
    public function donors()
    {
        $donors = Donation::orderBy('id', 'desc')->get();
        return view('backend.donors.index', compact('donors'));
    }
    public function blood_requests()
    {
        $blood_requests = Bloodrequest::orderBy('id', 'desc')->get();
        return view('backend.blood_requests.index', compact('blood_requests'));
    }
    public function members()
    {
        $members = Member::orderBy('id', 'desc')->get();
        return view('backend.members.index', compact('members'));
    }
}
