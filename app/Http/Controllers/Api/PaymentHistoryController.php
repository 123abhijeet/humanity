<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Bookpayment;
use App\Models\Backend\CoursePayment;
use App\Models\Backend\QuizPayment;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentHistoryController extends Controller
{
    public function all_payments_course()
    {
        try {
            $all_payments_course = CoursePayment::join('courses', 'course_payments.course_id', '=', 'courses.id')
                ->join('subcategories', 'courses.course_subcategory', '=', 'subcategories.id')
                ->where('course_payments.student_id', Auth::user()->id)
                ->select(
                    'course_payments.id as course_payment_id',
                    'course_payments.amount as amount',
                    'course_payments.due_amount as due_amount',
                    'course_payments.payment_type as payment_type',
                    'course_payments.discounted_amount as discounted_amount',
                    'courses.course_name as course_name',
                    'subcategories.subcategory_name as subcategory_name',
                    'courses.course_banner as course_banner',
                    'course_payments.payment_status as payment_status',
                    'course_payments.created_at as payment_date'
                )
                ->get();

            // Iterate through each payment to format the payment date
            $all_payments_course->transform(function ($payment) {
                $payment->course_banner = asset('Course Banner/' . $payment->course_banner);
                if ($payment->payment_type == 'monthly') {
                    $payment->total_amount  = $payment->amount - $payment->due_amount;
                } else {
                    $payment->total_amount = !empty($payment->discounted_amount) ? $payment->discounted_amount :  $payment->amount;
                }
                unset($payment->amount);
                unset($payment->due_amount);
                unset($payment->discounted_amount);
                unset($payment->payment_type);
                $payment->payment_date = \Carbon\Carbon::parse($payment->payment_date)->format('F d, Y');
                return $payment;
            });

            return response()->json(['all_payments_course' => $all_payments_course]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function all_payments_books()
    {
        try {
            $all_payments_books = Bookpayment::join('books', 'bookpayments.book_id', '=', 'books.id')
                ->join('subcategories', 'books.course_subcategory', '=', 'subcategories.id')
                ->where('bookpayments.student_id', Auth::user()->id)
                ->select(
                    'bookpayments.id as book_payment_id',
                    'subcategories.subcategory_name as subcategory_name',
                    'books.title as title',
                    'books.subject as subject',
                    'books.publication as publication',
                    'books.title as title',
                    'books.cover_image as cover_image',
                    'bookpayments.amount as total_amount',
                    'bookpayments.payment_status as payment_status',
                    'bookpayments.tracking_detail as tracking_detail',
                     'bookpayments.created_at as payment_date'
                )
                ->get();

            // Iterate through each payment to format the payment date
            $all_payments_books->transform(function ($payment) {
                $payment->cover_image = asset('Book Cover/' . $payment->cover_image);
                if (!empty($payment->tracking_detail)) {
                    $payment->tracking_detail = asset('Tracking Detail/' . $payment->tracking_detail);
                } else {
                    $payment->tracking_detail = '';
                }

                $payment->payment_date = \Carbon\Carbon::parse($payment->payment_date)->format('F d, Y');
                return $payment;
            });

            return response()->json(['all_payments_books' => $all_payments_books]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function all_payments_quiz()
    {
        try {
            $all_payments_quiz = QuizPayment::join('quizzes', 'quiz_payments.quiz_id', '=', 'quizzes.id')
                ->join('subcategories', 'quizzes.course_subcategory', '=', 'subcategories.id')
                ->where('quiz_payments.student_id', Auth::user()->id)
                ->select(
                    'quiz_payments.id as quiz_payment_id',
                    'quiz_payments.amount as amount',
                    'quiz_payments.discounted_amount as discounted_amount',
                    'quizzes.title as title',
                    'subcategories.subcategory_name as subcategory_name',
                    'quiz_payments.payment_status as payment_status',
                    'quiz_payments.created_at as payment_date'
                )
                ->get();

            $imagePath = asset('frontend/img/quiz.png');

            // Iterate through each payment to format the payment date
            $all_payments_quiz->transform(function ($payment) use ($imagePath) {
                $payment->total_amount = !empty($payment->discounted_amount) ? $payment->discounted_amount :  $payment->amount;
                // $payment->payment_date = Carbon::parse($payment->created_at)->format('F d Y');
                $payment->payment_date = \Carbon\Carbon::parse($payment->payment_date)->format('F d, Y');
                $payment->cover_image = $imagePath;
                unset($payment->discounted_amount);
                unset($payment->amount);
                return $payment;
            });

            return response()->json(['all_payments_quiz' => $all_payments_quiz]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function download_payment_detail($id)
    {
        try {
            $payment = CoursePayment::join('courses', 'course_payments.course_id', '=', 'courses.id')
                ->join('subcategories', 'courses.course_subcategory', '=', 'subcategories.id')
                ->join('users', 'course_payments.student_id', 'users.id')
                ->where('course_payments.id', $id)
                ->select(
                    'course_payments.amount as amount',
                    'courses.course_name as course_name',
                    'subcategories.subcategory_name as subcategory_name',
                    'courses.course_banner as course_banner',
                    'users.name as student_name',
                    'course_payments.created_at as payment_date' // Include payment date
                )
                ->first();

            // Format the payment date
            $payment->payment_date = Carbon::parse($payment->payment_date)->format('d F Y');

            // Prepend base URL to the course banner image path
            $payment->course_banner = asset('Course Banner/' . $payment->course_banner);

            return response()->json(['payment' => $payment]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
