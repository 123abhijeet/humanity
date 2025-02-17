<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Contact;
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
        return view('backend.index');
    }
    public function quizreport()
    {
        if (auth()->user()->hasRole('Admin')) {
            $quizreports = Quizresult::join('quizzes', 'quizresults.quiz_id', 'quizzes.id')
                ->whereNotNull('quizzes.price')
                ->get();
        } else {
            $quizreports = Quizresult::join('quizzes', 'quizresults.quiz_id', 'quizzes.id')
                ->whereNull('quizzes.price')
                ->get();
        }
        return view('backend.reports.quizreport', compact('quizreports'));
    }
    public function testreport()
    {
        $testresults = Testresult::all();
        return view('backend.reports.testreport', compact('testresults'));
    }
    public function subjectivetestreport()
    {
        $testresults = Subjectivetestresult::all();
        return view('backend.reports.subjectivetestreport', compact('testresults'));
    }
    public function subjectivetestquestions($test_id)
    {
        $subjective_test_questions = Testattemptquestion::whereNull('right_answer')->where('test_id', $test_id)->get();
        return view('backend.reports.subjectivetestquestions', compact('subjective_test_questions'));
    }
    public function subjectivetestanswer(Request $request)
    {
        $total_marks = 0;
        foreach ($request->question_id as $key => $questionId) {
            $marks = $request->marks[$key];
            $total_marks += $marks;
        }
        $total_score = $total_marks;

        Subjectivetestresult::where('test_id', $request->test_id)->update([
            'total_score' => $total_score
        ]);

        return redirect()->route('Subjective-Test-Reports')->with('success', 'Data Updated Successfully');
    }
    public function contacts()
    {
        $contacts = Contact::orderBy('id', 'desc')->get();
        return view('backend.contacts', compact('contacts'));
    }
    public function contact_delete($id)
    {
        Contact::where('id', $id)->delete();
        return redirect()->back()->with('error', 'Data removed successfully');
    }
    public function teachers_enrolled()
    {
        $todays_teachers_enrolled = Teacher::whereDate('created_at',Carbon::today())->get();
        return view('backend.todays_enrollment.teachers_index', compact('todays_teachers_enrolled'));
    }
    public function students_enrolled()
    {
        $todays_students_enrolled = Student::whereDate('created_at',Carbon::today())->get();
        return view('backend.todays_enrollment.students_index', compact('todays_students_enrolled'));
    }
}
