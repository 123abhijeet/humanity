<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Offer;
use App\Models\Backend\QuizPayment;
use App\Models\Backend\Student;
use App\Models\Backend\Teacher;
use App\Models\Teacher\Quiz;
use App\Models\Teacher\Quizattemptquestion;
use App\Models\Teacher\Quizquestion;
use App\Models\Teacher\Quizresult;
use App\Models\Teacher\Teachersquizpayment;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function get_paid_quizzes()
    {
        try {
            $userEmail = Auth::user()->email;
            $user_details = Student::where('email', $userEmail)->first();

            // Retrieve all paid quizzes for the user's category and subcategory
            $quizzes = Quiz::where('course_category', $user_details->category)
                ->where('course_subcategory', $user_details->subcategory)
                ->whereNotNull('price')
                ->select('id', 'title', 'total_questions', 'total_time', 'level', 'price', 'attempt_date', 'subject')
                ->get();

            // Add the purchase status and quiz attempt status for each quiz
            foreach ($quizzes as $quiz) {
                // Check if the quiz has been purchased by the authenticated user
                $isPurchased = QuizPayment::where('student_id', Auth::user()->id)
                    ->where('quiz_id', $quiz->id)
                    ->exists();

                // Check if the quiz has been attempted by the authenticated user
                $isAttempted = Quizresult::where('student_id', Auth::user()->id)
                    ->where('quiz_id', $quiz->id)
                    ->exists();

                if ($quiz->attempt_date) {
                    // Parse the attempt_date and split into date and time
                    $dateTime = new DateTime($quiz->attempt_date);
                    $quiz->date = $dateTime->format('d-m-Y');  // e.g., "04-10-2024"
                    $quiz->time = $dateTime->format('H:i');
                }
                // Remove attempt_date from the response
                unset($quiz->attempt_date);

                // Set the purchase_status and attempt_status
                $quiz->purchase_status = $isPurchased ? 'Purchased' : 'Not Purchased';
                $quiz->attempt_status = $isAttempted ? 'Attempted' : 'Not Attempted';
            }

            // Return the quizzes with their respective purchase and attempt statuses
            return response()->json(['quizzes' => $quizzes]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function get_quiz_subjects()
    {
        $subjects = Quiz::whereNotNull('subject')->distinct()->pluck('subject');

        return response()->json(['subjects' => $subjects]);
    }
    public function get_quiz_by_subjects(Request $request)
    {
        $userEmail = Auth::user()->email;
        $user_details = Student::where('email', $userEmail)->first();

        $quizzes = Quiz::where('course_category', $user_details->category)->where('course_subcategory', $user_details->subcategory)
            ->where('subject', $request->subject)
            ->select('id', 'title', 'total_questions', 'total_time', 'level', 'subject')
            ->whereNull('price')
            ->get();

        $quizzes = $quizzes->map(function ($quiz) {
            // Check if the quiz id and user id exist in the quizresult table
            $quizResultExists = Quizresult::where('quiz_id', $quiz->id)
                ->where('student_id', Auth::user()->id)
                ->exists();

            // Set the status based on whether the record exists
            $quiz->status = $quizResultExists ? 1 : 0;

            return $quiz;
        });
        return response()->json(['quizzes' => $quizzes]);
    }
    public function get_quiz_teachers()
    {
        $userEmail = Auth::user()->email;
        $user_details = Student::where('email', $userEmail)->first();

        $teachers = DB::table('teachers')
            ->leftJoin('quizzes', 'teachers.user_id', '=', 'quizzes.teacher_id')
            ->where('teachers.course_category', $user_details->category)->where('teachers.course_subcategory', $user_details->subcategory)
            ->select('teachers.id', 'teachers.name', 'teachers.picture', 'teachers.experience', DB::raw('COUNT(quizzes.id) as total_quiz'))
            ->groupBy('teachers.id', 'teachers.name', 'teachers.picture', 'teachers.experience')
            ->get();

        // Iterate through each subject and prepend the base URL to the picture field
        $teachers->transform(function ($teacher) {
            $teacher->picture = asset('Teacher Picture/' . $teacher->picture);
            return $teacher;
        });

        return response()->json(['teachers' => $teachers]);
    }
    public function get_quiz_by_teachers(Request $request)
    {
        $teacher = Teacher::where('name', $request->teacher)->first();

        $quizzes = Quiz::where('teacher_id', $teacher->user_id)
            ->whereNull('price')
            ->get();

        $quizzes = $quizzes->map(function ($quiz) {
            // Check if the quiz id and user id exist in the quizresult table
            $quizResultExists = Quizresult::where('quiz_id', $quiz->id)
                ->where('student_id', Auth::user()->id)
                ->exists();

            // Set the status based on whether the record exists
            $quiz->status = $quizResultExists ? 1 : 0;

            return $quiz;
        });
        return response()->json(['quizzes' => $quizzes]);
    }
    public function get_quiz_questions($quiz_id)
    {
        $quiz_questions = Quiz::join('quizquestions', 'quizzes.id', 'quizquestions.quiz_id')
            ->where('quizzes.id', $quiz_id)
            ->select('quizzes.*', 'quizquestions.*')
            ->get();
        return response()->json(['quiz_questions' => $quiz_questions]);
    }
    public function next_question(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "quiz_id" => "required",
            "question_id" => "required",
            "answer" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->getMessageBag()->toArray()], 401);
        }
        $data = $request->all();
        $question_detail = Quizquestion::where('id', $request->question_id)->first();
        $data['right_answer'] = $question_detail->answer;
        $data['student_id'] = Auth::user()->id;
        $data['question'] = $question_detail->question;
        $data['option_a'] = $question_detail->option_a;
        $data['option_b'] = $question_detail->option_b;
        $data['option_c'] = $question_detail->option_c;
        $data['option_d'] = $question_detail->option_d;
        $count = Quizattemptquestion::where('question_id', $request->question_id)->count();
        if ($count > 0) {
            Quizattemptquestion::where('question_id', $request->question_id)->update($data);
        } else {
            Quizattemptquestion::create($data);
        }
        return response()->json(["success" => "Data Submitted"]);
    }
    public function all_attempted_questions($quiz_id)
    {
        $attemted_questions =  Quizattemptquestion::where('quiz_id', $quiz_id)->get();
        return response()->json(['attemted_questions' => $attemted_questions]);
    }
    public function submit_quiz(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "quiz_id" => "required",
            "time_taken" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->getMessageBag()->toArray()], 401);
        }
        $data = $request->all();
        $attemptQuestions = Quizattemptquestion::where('quiz_id', $request->quiz_id)
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


        Quizresult::create($data);
        return response()->json(["success" => "Data Submitted"]);
    }

    public function get_all_quiz_result()
    {
        try {
            $student_id = Auth::user()->id;
            $quizResults = Quizresult::where('student_id', $student_id)->get();
            $result = [];

            foreach ($quizResults as $quizResult) {
                $quiz = Quiz::findOrFail($quizResult->quiz_id);

                $attemptQuestions = Quizattemptquestion::where('quiz_id', $quizResult->quiz_id)
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
                    'quiz_id' => $quizResult->quiz_id,
                    'quiz_title' => $quiz->title,
                    'total_time' => $quiz->total_time,
                    'time_taken' => $quizResult->time_taken,
                    'total_questions' => $totalQuestions,
                    'right_count' => $rightCount,
                    'wrong_count' => $wrongCount,
                    'score' => $quizResult->total_score,
                    'total_score' => $totalQuestions * 10,
                ];
            }

            return response()->json(['quiz_results' => $result]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function get_quiz_result($quiz_id)
    {
        $student_id = Auth::user()->id;
        try {
            $quizResults = Quizresult::where('quiz_id', $quiz_id)->where('student_id', $student_id)->first();
            $result = [];

            $quiz = Quiz::findOrFail($quizResults->quiz_id);

            $attemptQuestions = Quizattemptquestion::where('quiz_id', $quizResults->quiz_id)
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

            $date = Carbon::parse($quizResults->created_at);
            $dateString = $date->format('d-m-Y');
            $dateTime = DateTime::createFromFormat('d-m-Y', $dateString);
            $formattedDate = $dateTime->format('d F Y');
            $result[] = [
                'quiz_id' => $quizResults->quiz_id,
                'quiz_title' => $quiz->title,
                'time_taken' => $quizResults->time_taken,
                'total_questions' => $totalQuestions,
                'right_count' => $rightCount,
                'wrong_count' => $wrongCount,
                'name' => Auth::user()->name,
                'date' => $formattedDate,
                'total_time' => $quiz->total_time,
                'score' => $quizResults->total_score,
                'total_score' => $totalQuestions * 10,
            ];

            return response()->json(['quiz_results' => $result]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function purchase_quiz(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "quiz_id" => "required",
                "transaction_id" => "required",
                "payment_status" => "required"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Invalid Inputs",
                    "error" => $validator->getMessageBag()->toArray()
                ], 401);
            } else {
                $quiz = Quiz::where('id', $request->quiz_id)->first();
                QuizPayment::create([
                    'quiz_id' => $request->quiz_id,
                    'student_id' => Auth::user()->id,
                    'transaction_id' => $request->transaction_id,
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'amount' => $quiz->price,
                    'coupon_code' => $request->coupon_code ? $request->coupon_code : null,
                    'coupon_amount' => $request->coupon_amount ? $request->coupon_amount : null,
                    'discounted_amount' => $request->discounted_amount ? $request->discounted_amount : null,
                    'payment_status' => $request->payment_status,
                ]);
                return response()->json([
                    "status" => true,
                    "message" => "Payment Successfull",
                ], 201);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred while Payment.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function quiz_purchase_status($id)
    {
        $check = QuizPayment::where('quiz_id', $id)->where('student_id', auth()->user()->id)->count();
        return response()->json(['check' => $check]);
    }
    public function quiz_history()
    {
        $quizzes = Quiz::join('quizresults', 'quizzes.id', 'quizresults.quiz_id')
            ->where('student_id', auth()->user()->id)
            ->select('quizzes.id', 'quizzes.title', 'quizzes.total_questions', 'quizzes.total_time', 'quizzes.level', 'quizzes.subject')
            ->get();
        return response()->json(['quizzes' => $quizzes]);
    }
    public function all_quiz()
    {
        $userEmail = Auth::user()->email;
        $user_details = Student::where('email', $userEmail)->first();

        $quizzes = Quiz::where('course_category', $user_details->category)->where('course_subcategory', $user_details->subcategory)
            ->whereNull('price')
            ->select('id', 'title', 'total_questions', 'total_time', 'level', 'subject')
            ->get();


        $quizzes = $quizzes->map(function ($quiz) {
            $quizResultExists = Quizresult::where('quiz_id', $quiz->id)
                ->where('student_id', Auth::user()->id)
                ->exists();

            // Set the status based on whether the record exists
            $quiz->status = $quizResultExists ? 1 : 0;

            return $quiz;
        });
        return response()->json(['quizzes' => $quizzes]);
    }
    public function quiz_payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "quiz_id" => "required",
            "coupon_code" => ""
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => "Invalid Inputs",
                "error" => $validator->getMessageBag()->toArray()
            ], 401);
        } else {
            $quiz_details = Quiz::where('id', $request->quiz_id)->select('id', 'title', 'subject', 'price', 'attempt_date')->first();

            $quiz_details = collect([$quiz_details])->transform(function ($quiz) {
                $quiz->attempt_date = Carbon::parse($quiz->attempt_date)->format('d F Y');
                return $quiz;
            })->first();

            if (!empty($request->coupon_code)) {
                $today = date('Y-m-d');

                $offer = Offer::where('offer_code', $request->coupon_code)
                    ->where('quiz_id', $request->quiz_id)
                    ->where('offer_type', 'quiz')
                    ->whereDate('start_date', '<=', $today)
                    ->whereDate('end_date', '>=', $today)
                    ->where('status', '1')
                    ->first();
                if ($offer) {
                    $quiz_details['coupon_amount'] = $offer->offer_value;
                    $quiz_details['amount_payable'] = round($quiz_details->price - $offer->offer_value, 2);
                    $quiz_details['coupon_code'] = $request->coupon_code;
                    return response()->json(["status" => true,    "message" => "Coupon Applied Sucessfully.", 'quiz_details' => $quiz_details], 200);
                } else {
                    $quiz_details['amount_payable'] = $quiz_details->price;
                    return response()->json(["status" => false,    "message" => "Coupon Doesn't Exists.", 'quiz_details' => $quiz_details], 200);
                }
            } else {
                $quiz_details['amount_payable'] = $quiz_details->price;
                return response()->json(['quiz_details' => $quiz_details]);
            }
        }
    }
    public function get_quiz_winners()
    {
        try {
            $quiz_winners = Quizresult::join('quizzes', 'quizresults.quiz_id', '=', 'quizzes.id')
                ->join('users', 'quizresults.student_id', '=', 'users.id')
                ->whereNotNull('quizzes.price')
                ->where('quizzes.attempt_date', '>=', Carbon::now()->subDays(7))
                ->select(
                    'quizresults.quiz_id',
                    'quizzes.title',
                    'users.name as student_name',
                    'quizzes.subject',
                    'quizzes.level',
                    'quizzes.total_questions',
                    'quizzes.total_time',
                    'quizresults.time_taken',
                    'quizresults.total_right',
                    'quizresults.total_score',
                    'quizzes.attempt_date as quiz_date'
                )
                ->get()
                ->groupBy('quiz_id')
                ->map(function ($group) {
                    // Sort by total_score (desc) and time_taken (asc)
                    return $group->sortBy(function ($item) {
                        $total_score = is_numeric($item->total_score) ? $item->total_score : 0;

                        // Convert time_taken to total seconds for correct comparison
                        $time_taken_seconds = $this->convertTimeToSeconds($item->time_taken);

                        return [$total_score * -1, $time_taken_seconds];
                    })->first();
                })
                ->values();

            // Format the quiz_date field
            $quiz_winners->transform(function ($quiz_winner) {
                $quiz_winner->quiz_date = Carbon::parse($quiz_winner->quiz_date)->format('M d, Y');
                return $quiz_winner;
            });

            // Return the first element as an object
            return response()->json($quiz_winners->first());
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    private function convertTimeToSeconds($time_taken)
    {
        if (!$time_taken || strpos($time_taken, ':') === false) {
            return PHP_INT_MAX; // Return a large value if time_taken is invalid
        }

        list($minutes, $seconds) = explode(':', $time_taken);
        return ($minutes * 60) + $seconds;
    }


    public function reset_previous_quiz($quiz_id)
    {
        $quizDeleted =  Quizattemptquestion::where('quiz_id', $quiz_id)
            ->where('student_id', Auth::user()->id)
            ->delete();

        if ($quizDeleted) {
            Quizresult::where('quiz_id', $quiz_id)
                ->where('student_id', Auth::user()->id)
                ->delete();
        }
    }
}
