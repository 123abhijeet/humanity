<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Backend\Bookpayment;
use App\Models\Backend\Course;
use App\Models\Backend\CoursePayment;
use App\Models\Backend\QuizPayment;
use App\Models\Teacher\Teacherscoursepayment;
use App\Models\Teacher\Teachersquizpayment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function course_payments()
    {
        $course_payments = Teacherscoursepayment::where('teacher_id', Auth::user()->id)->latest()->get();
        return view('backend.teachers-payments.course_payments', compact('course_payments'));
    }
    public function all_book_payments()
    {
        $all_book_payments = Bookpayment::latest()->get();
        return view('backend.payments.all_book_payments', compact('all_book_payments'));
    }
    public function upload_book_tracking_detail(Request $request, $id)
    {
        try {

            $current_tracking_detail = Bookpayment::findOrFail($id)->tracking_detail;

            if ($request->hasFile('tracking_detail') && $request->file('tracking_detail')->isValid()) {
                $tracking_detail = time() . 'tracking_detail' . '.' . $request->tracking_detail->extension();
                $request->tracking_detail->move(public_path('Tracking Detail'), $tracking_detail);
                if ($current_tracking_detail) {
                    unlink(public_path('Tracking Detail') . '/' . $current_tracking_detail);
                }
            } else {
                $tracking_detail = $current_tracking_detail;
            }
            Bookpayment::where('id', $id)->update([
                'tracking_detail' => $tracking_detail
            ]);
            return redirect()->route('Book-Payments')->with('success', 'Tracking Detail Uploaded Successfully');
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function teachers_course_payments()
    {
        $teachers_course_payments = Teacherscoursepayment::latest()->get();
        return view('backend.payments.teachers_course_payments', compact('teachers_course_payments'));
    }
    public function all_course_payments()
    {
        $all_course_payments = CoursePayment::latest()->get();
        return view('backend.payments.all_course_payments', compact('all_course_payments'));
    }
    public function upload_course_payment_proof(Request $request, $id)
    {
        try {
            $current_payment_proof = Teacherscoursepayment::findOrFail($id)->payment_proof;

            if ($request->hasFile('payment_proof') && $request->file('payment_proof')->isValid()) {
                $payment_proof = time() . 'payment_proof' . '.' . $request->payment_proof->extension();
                $request->payment_proof->move(public_path('Course Payment Proof'), $payment_proof);
                if ($current_payment_proof) {
                    unlink(public_path('Course Payment Proof') . '/' . $current_payment_proof);
                }
            } else {
                $payment_proof = $current_payment_proof;
            }
            Teacherscoursepayment::where('id', $id)->update([
                'payment_status' => 'Paid',
                'payment_proof' => $payment_proof
            ]);
            return redirect()->route('Course-Payments')->with('success', 'Proof Uploaded Successfully');
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function all_quiz_payments()
    {
        $all_quiz_payments = QuizPayment::latest()->get();
        return view('backend.payments.all_quiz_payments', compact('all_quiz_payments'));
    }
}
