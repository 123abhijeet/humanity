<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Student;
use App\Models\Teacher\Subjectivetestresult;
use App\Models\Teacher\Test;
use App\Models\Teacher\Testattemptquestion;
use App\Models\Teacher\Testquestion;
use App\Models\Teacher\Testresult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;

class SubjectiveTestController extends Controller
{
    public function get_subjective_test_by_subjects(Request $request)
    {
        $userEmail = Auth::user()->email;
        $user_details = Student::where('email', $userEmail)->first();

        $tests = Test::where('course_category', $user_details->category)->where('course_subcategory', $user_details->subcategory)
            ->where('subject', $request->subject)
            ->where('type', '=', 'Subjective')
            ->select('id', 'title', 'total_questions', 'total_time', 'level', 'subject', 'type')
            ->get();
        return response()->json(['tests' => $tests]);
    }
    public function get_subjective_test_questions($test_id)
    {
        $test_questions = Test::join('testquestions', 'tests.id', 'testquestions.test_id')
            ->whereNull('testquestions.answer')
            ->where('tests.id', $test_id)
            ->select(
                'tests.id as test_id',
                'tests.teacher_id as teacher_id',
                'tests.course_category as course_category',
                'tests.course_subcategory as course_subcategory',
                'tests.course as course',
                'tests.title as title',
                'tests.subject as subject',
                'tests.total_questions as total_questions',
                'tests.total_time as total_time',
                'tests.type as type',
                'tests.level as level',
                'testquestions.id as testquestions_id',
                'testquestions.question as question'
            )
            ->get();
        return response()->json(['test_questions' => $test_questions]);
    }
    public function next_subjective_test_question(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "test_id" => "required",
            "question_id" => "required",
            "answer" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->getMessageBag()->toArray()], 401);
        }
        $data = $request->all();
        $question_detail = Testquestion::where('id', $request->question_id)->first();
        $data['student_id'] = Auth::user()->id;
        $data['question'] = $question_detail->question;
        $count = Testattemptquestion::where('question_id', $request->question_id)->count();
        if ($count > 0) {
            Testattemptquestion::where('question_id', $request->question_id)->update($data);
        } else {
            Testattemptquestion::create($data);
        }
        return response()->json(["success" => "Data Submitted"]);
    }
    public function all_attempted_subjective_test_questions($test_id)
    {
        $attemted_questions =  Testattemptquestion::where('test_id', $test_id)->whereNull('option_a')->get();
        return response()->json(['attemted_questions' => $attemted_questions]);
    }
    public function submit_subjective_test(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "test_id" => "required",
            "time_taken" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->getMessageBag()->toArray()], 401);
        }
        $data = $request->all();
        $count = Testattemptquestion::where('test_id', $request->test_id)->count();
        $data['student_id'] = Auth::user()->id;
        $data['total_question'] = $count;
        Subjectivetestresult::create($data);
        return response()->json(["success" => "Data Submitted"]);
    }
    public function get_subjective_test_result(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "test_id" => "required",
        ]);

        $student_id = Auth::user()->id;
        if ($validator->fails()) {
            return response()->json(["error" => $validator->getMessageBag()->toArray()], 401);
        }

        try {
            $testResults = Subjectivetestresult::where('test_id', $request->test_id)->where('student_id', $student_id)->whereNotNull('total_right')->first();

            $test = Test::findOrFail($testResults->test_id);
            $result = [];

            $test = Test::findOrFail($testResults->test_id);

            $attemptQuestions = Testattemptquestion::where('test_id', $testResults->test_id)
                ->where('student_id', $student_id)
                ->get();

            $totalQuestions = count($attemptQuestions);
            $date = Carbon::parse($testResults->created_at);
            $dateString = $date->format('d-m-Y');
            $dateTime = DateTime::createFromFormat('d-m-Y', $dateString);
            $formattedDate = $dateTime->format('d F Y');

            $result[] = [
                'test_id' => $testResults->test_id,
                'test_title' => $test->title,
                'time_taken' => $testResults->time_taken,
                'total_questions' => $totalQuestions,
                'name' => Auth::user()->name,
                'date' => $formattedDate,
                'total_time' => $test->total_time,
                'score' => $testResults->total_score,
                'total_score' => $totalQuestions * 10,
            ];
            return response()->json(['test_results' => $result]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function get_all_subjective_test_result()
    {
        try {
            $student_id = Auth::user()->id;
            $testResults = Subjectivetestresult::where('student_id', $student_id)->whereNotNull('total_right')->get();
            $result = [];

            foreach ($testResults as $testResult) {
                $test = Test::findOrFail($testResult->test_id);
                $attemptQuestions = Testattemptquestion::where('test_id', $testResult->test_id)
                    ->where('student_id', $student_id)
                    ->get();

                $totalQuestions = count($attemptQuestions);
                $result[] = [
                    'test_id' => $testResult->test_id,
                    'test_title' => $test->title,
                    'time_taken' => $testResult->time_taken,
                    'total_questions' => $totalQuestions,
                    'name' => Auth::user()->name,
                    'total_time' => $test->total_time,
                    'score' => $testResult->total_score,
                    'total_score' => $totalQuestions * 10,
                ];
            }
            return response()->json(['result' => $result]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function subjective_test_history()
    {
        $tests = Test::join('subjectivetestresults', 'tests.id', 'subjectivetestresults.test_id')
            ->where('tests.type', 'Subjective')
            ->where('student_id', auth()->user()->id)
            ->select('tests.id', 'tests.title', 'tests.total_questions', 'tests.total_time', 'tests.level', 'tests.subject')
            ->get();
        return response()->json(['tests' => $tests]);
    }
    public function all_subjective_test($course_id)
    {
        $userEmail = Auth::user()->email;
        $user_details = Student::where('email', $userEmail)->first();

        $tests = Test::where('course_category', $user_details->category)->where('course_subcategory', $user_details->subcategory)
            ->where('type', 'Subjective')
            ->where('course',$course_id)
            ->select('id', 'title', 'total_questions', 'total_time', 'level', 'subject')
            ->get();
        return response()->json(['tests' => $tests]);
    }
    public function reset_previous_subjective_test($test_id)
    {
        $testDeleted =  Testattemptquestion::where('test_id', $test_id)
            ->where('student_id', Auth::user()->id)
            ->delete();

        if ($testDeleted) {
            Subjectivetestresult::where('test_id', $test_id)
                ->where('student_id', Auth::user()->id)
                ->delete();
        }
    }
}
