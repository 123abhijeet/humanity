<?php

namespace App\Http\Controllers\Api;

use App\Helpers\certificate_no_helper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Course;
use App\Models\Backend\Coursecertificate;
use App\Models\Backend\Coursecompleted;
use App\Models\Backend\Soldcourse;
use App\Models\Teacher\Test;
use App\Models\Teacher\Testattemptquestion;
use App\Models\Teacher\Testquestion;
use App\Models\Teacher\Testresult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Backend\Student;
use App\Models\Teacher\Videoviewedtime;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ObjectiveTestController extends Controller
{
    public function get_demo_test()
    {
        $userEmail = Auth::user()->email;
        $user_details = Student::where('email', $userEmail)->first();

        $test = Test::where('type', '=', 'Objective')
            ->where('course_category', $user_details->category)->where('course_subcategory', $user_details->subcategory)
            ->select('id', 'title', 'total_questions', 'total_time', 'level', 'subject', 'type')
            ->first();
        return response()->json(['test' => $test]);
    }
    public function get_test_subjects()
    {
        $subjects = Test::whereNotNull('subject')->distinct()->pluck('subject');

        return response()->json(['subjects' => $subjects]);
    }
    public function get_objective_test_by_subjects(Request $request)
    {
        $userEmail = Auth::user()->email;
        $user_details = Student::where('email', $userEmail)->first();

        $tests = Test::where('course_category', $user_details->category)->where('course_subcategory', $user_details->subcategory)
            ->where('subject', $request->subject)
            ->where('type', '=', 'Objective')
            ->select('id', 'title', 'total_questions', 'total_time', 'level', 'subject', 'type')
            ->get();
        return response()->json(['tests' => $tests]);
    }
    public function get_test_questions($test_id)
    {
        $test_questions = Test::join('testquestions', 'tests.id', 'testquestions.test_id')
            ->where('tests.id', $test_id)
            ->select('tests.*', 'testquestions.*')
            ->get();
        return response()->json(['test_questions' => $test_questions]);
    }
    public function next_objective_test_question(Request $request)
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
        $data['right_answer'] = $question_detail->answer;
        $data['student_id'] = Auth::user()->id;
        $data['question'] = $question_detail->question;
        $data['option_a'] = $question_detail->option_a;
        $data['option_b'] = $question_detail->option_b;
        $data['option_c'] = $question_detail->option_c;
        $data['option_d'] = $question_detail->option_d;
        $count = Testattemptquestion::where('question_id', $request->question_id)->count();
        if ($count > 0) {
            Testattemptquestion::where('question_id', $request->question_id)->update($data);
        } else {
            Testattemptquestion::create($data);
        }
        return response()->json(["success" => "Data Submitted"]);
    }
    public function all_attempted_objective_test_questions($test_id)
    {
        $attemted_questions =  Testattemptquestion::where('test_id', $test_id)->whereNotNull('option_a')->get();
        return response()->json(['attemted_questions' => $attemted_questions]);
    }
    public function submit_objective_test(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "test_id" => "required",
            "time_taken" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->getMessageBag()->toArray()], 401);
        }
        $data = $request->all();
        $attemptQuestions = Testattemptquestion::where('test_id', $request->test_id)
            ->where('student_id', Auth::user()->id)
            ->get();

        $totalQuestions = count($attemptQuestions);
        $rightCount = 0;
        $wrongCount = 0;

        foreach ($attemptQuestions as $attemptQuestion) {
            if ($attemptQuestion->answer === $attemptQuestion->right_answer) {
                $rightCount++;
            } else {
                $wrongCount++;
            }
        }

        $data['student_id'] = Auth::user()->id;
        $data['total_question'] = $totalQuestions;
        $data['total_right'] = $rightCount;
        $data['total_wrong'] = $wrongCount;
        $data['total_score'] = ($totalQuestions - $wrongCount) * 10;

        Testresult::create($data);

        $test = Test::where('id', $request->test_id)->first();
        $course_start_date = Soldcourse::where('course_id', $test->course)->where('student_id', Auth::user()->id)->first();
        $course = Course::where('id', $test->course)->first();

        if ($test->title == 'Final Test') {
            $check_certificate = Coursecertificate::where('course_id', $test->course)->where('student_id', Auth::user()->id)->first();
            if (!$check_certificate) {
                Coursecompleted::create([
                    'student_id' => Auth::user()->id,
                    'teacher_id' => $test->teacher_id,
                    'course_id' => $test->course,
                    'course_start_date' => $course_start_date->created_at,
                    'course_end_date' => Carbon::now()
                ]);

                $category = Category::where('category_name', 'Class')->first();

                $user = Student::where('category', $category->id)->first();

                if (!$user) {
                    $certificate_no = certificate_no_helper::nextCertificateNo();

                    $course_certificate_details = Coursecertificate::where('student_id', Auth::user()->id)->where('course_id', $test->course)->first();
                    // Generate PDF
                    $pdf = Pdf::loadView('certificate', [
                        'student_name' => Auth::user()->name,
                        'course_name' => $course->course_name,
                        'course_start_date' => $course_certificate_details->created_at->format('F d, Y'),
                        'course_end_date' => Carbon::now()->format('F d, Y'),
                        'certificate_issued_date' => Carbon::now()->format('F d, Y'),
                        'certificate_no' => $course_certificate_details->certificate_no
                    ]);

                    $pdf_content = $pdf->output();

                    $relativePdfPath = 'Course Certificate/' . $course_certificate_details->certificate_no . '.pdf';

                    // Ensure the directory exists
                    if (!file_exists(public_path('Course Certificate'))) {
                        mkdir(public_path('Course Certificate'), 0755, true);
                    }

                    // Save the generated PDF content to the public folder
                    file_put_contents($relativePdfPath, $pdf_content);

                    Coursecertificate::create([
                        'certificate_no' => $certificate_no,
                        'student_id' => Auth::user()->id,
                        'teacher_id' => $test->teacher_id,
                        'course_id' => $test->course,
                        'course_start_date' => $course_start_date->created_at,
                        'course_end_date' => Carbon::now(),
                        'course_issued_date' => $course->created_at,
                        'certificate_issued_date' => Carbon::now(),
                        'certificate' => $relativePdfPath
                    ]);
                }
            }
        }
        return response()->json(["success" => "Data Submitted"]);
    }
    public function get_objective_test_result(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "test_id" => "required",
        ]);

        $student_id = Auth::user()->id;
        if ($validator->fails()) {
            return response()->json(["error" => $validator->getMessageBag()->toArray()], 401);
        }

        try {
            $testResults = Testresult::where('test_id', $request->test_id)->where('student_id', $student_id)->first();
            $test = Test::findOrFail($testResults->test_id);
            $result = [];

            $test = Test::findOrFail($testResults->test_id);

            $attemptQuestions = Testattemptquestion::where('test_id', $testResults->test_id)
                ->where('student_id', $student_id)
                ->get();

            $totalQuestions = count($attemptQuestions);
            $rightCount = 0;
            $wrongCount = 0;

            foreach ($attemptQuestions as $attemptQuestion) {
                if ($attemptQuestion->answer === $attemptQuestion->right_answer) {
                    $rightCount++;
                } else {
                    $wrongCount++;
                }
            }
            $date = Carbon::parse($testResults->created_at);
            $dateString = $date->format('d-m-Y');
            $dateTime = DateTime::createFromFormat('d-m-Y', $dateString);
            $formattedDate = $dateTime->format('d F Y');

            $result[] = [
                'test_id' => $testResults->test_id,
                'test_title' => $test->title,
                'time_taken' => $testResults->time_taken,
                'total_questions' => $totalQuestions,
                'right_count' => $rightCount,
                'wrong_count' => $wrongCount,
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
    public function get_all_objective_test_result()
    {
        try {
            $student_id = Auth::user()->id;
            $testResults = Testresult::where('student_id', $student_id)->get();

            $result = [];

            foreach ($testResults as $testResult) {
                $test = Test::findOrFail($testResult->test_id);

                $attemptQuestions = Testattemptquestion::where('test_id', $testResult->test_id)
                    ->where('student_id', $student_id)
                    ->get();

                $totalQuestions = count($attemptQuestions);
                $rightCount = 0;
                $wrongCount = 0;

                foreach ($attemptQuestions as $attemptQuestion) {
                    if ($attemptQuestion->answer === $attemptQuestion->right_answer) {
                        $rightCount++;
                    } else {
                        $wrongCount++;
                    }
                }

                $result[] = [
                    'test_id' => $testResult->test_id,
                    'test_title' => $test->title,
                    'total_time' => $test->total_time,
                    'time_taken' => $testResult->time_taken,
                    'total_questions' => $totalQuestions,
                    'right_count' => $rightCount,
                    'wrong_count' => $wrongCount,
                    'score' => $testResult->total_score,
                    'total_score' => $totalQuestions * 10,
                ];
            }

            return response()->json(['test_results' => $result]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function objective_test_history()
    {
        $tests = Test::join('testresults', 'tests.id', 'testresults.test_id')
            ->where('type', 'Objective')
            ->where('student_id', auth()->user()->id)
            ->select('tests.id', 'tests.title', 'tests.total_questions', 'tests.total_time', 'tests.level', 'tests.subject')
            ->get();
        return response()->json(['tests' => $tests]);
    }
    public function all_objective_test($course_id)
    {
        $userEmail = Auth::user()->email;
        $user_details = Student::where('email', $userEmail)->first();

        $tests = Test::where('course_category', $user_details->category)->where('course_subcategory', $user_details->subcategory)
            ->where('type', 'Objective')
            ->where('course',$course_id)
            ->select('id', 'title', 'total_questions', 'total_time', 'level', 'subject')
            ->get();
        return response()->json(['tests' => $tests]);
    }
    public function reset_previous_objective_test($test_id)
    {
        $testDeleted =  Testattemptquestion::where('test_id', $test_id)
            ->where('student_id', Auth::user()->id)
            ->delete();

        if ($testDeleted) {
            Testresult::where('test_id', $test_id)
                ->where('student_id', Auth::user()->id)
                ->delete();
        }
    }
}
