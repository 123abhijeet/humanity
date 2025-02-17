<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\UserRegistered;
use App\Models\Backend\Book;
use App\Models\Backend\Category;
use App\Models\Backend\Contact;
use App\Models\Backend\Course;
use App\Models\Backend\CoursePayment;
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
        $books = Book::all();
        $courses = Course::all();
        $teachers = Teacher::all();
        return view('frontend.index', compact('books', 'courses', 'teachers'));
    }
    public function about()
    {
        $teachers = Teacher::all();
        return view('frontend.about', compact('teachers'));
    }
    public function coming_soon()
    {
        return view('frontend.coming_soon');
    }
    public function courses()
    {
        $books = Book::all();
        $courses = Course::all();
        return view('frontend.courses', compact('books', 'courses'));
    }
    public function our_mentors()
    {
        $teachers = Teacher::all();
        return view('frontend.our_mentors', compact('teachers'));
    }
    public function contact()
    {
        return view('frontend.contact');
    }
    public function store_contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'mobile' => ['required'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        Contact::create($data);
        return redirect()->back()->with('success', 'Your message is submitted, we will contact you shortly');
    }
    public function join_as_mentor()
    {
        $category = Category::all();
        return view('frontend.join_as_mentor', compact('category'));
    }
    public function store_mentor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_category' => ['required'],
            'course_subcategory' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('teachers', 'email')],
            'mobile' => ['required', Rule::unique('teachers', 'mobile')],
            'qualification' => ['required', 'string', 'max:255'],
            'experience' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'picture' => ['required', 'max:500'], // Maximum size in kilobytes
            'identity_proof' => ['required', 'max:200'], // Maximum size in kilobytes
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        if ($request->picture) {
            $picture = time() . 'picture' . '.' . $request->picture->extension();
            $request->picture->move(public_path('Teacher Picture'), $picture);
            $data['picture'] = $picture;
        }
        if ($request->identity_proof) {
            $identity_proof = time() . 'identity_proof' . '.' . $request->identity_proof->extension();
            $request->identity_proof->move(public_path('Identity Proof'), $identity_proof);
            $data['identity_proof'] = $identity_proof;
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->mobile),
            'status' => 0
        ]);
        $data['user_id'] = $user->id;
        Teacher::create($data);
        try {
            Mail::to($user->email)->send(new UserRegistered($user->name, $user->email, $request->mobile));
        } catch (Exception $exception) {
            \Log::error('Mail sending error: ' . $exception->getMessage());
        }
        $user->assignRole('Teacher');
        return redirect()->back()->with('success', 'Your application is submitted, wait for approval from Admin (Check your email for login credentials)');
    }
    public function payment_receipt()
    {
        return view('payment_receipt');
    }
    public function generate_payment_receipt()
    {
        $receipt_number = 'SAT' . date('dmY') . Auth::user()->id;
        $student_detail = Student::where('email',Auth::user()->email)->first();
        $payment_detail = CoursePayment::where('course_id',1)->where('student_id',12)->first();
        $category = Category::where('id',$student_detail->category)->first();
        $subcategory = Subcategory::where('id',$student_detail->subcategory)->first();
        $course = Course::where('id', 1)->first();
        // Generate PDF

        $pdf = Pdf::loadView('payment_receipt', [
            'student_name' => Auth::user()->name,
            'course_name' => $course->course_name,
            'course_uid' => $course->course_uid,
            'course_fee' => $course->course_fee,
            'duration' => $course->course_duration,
            'amount' => $payment_detail->amount,
            'payment_type' => $course->payment_type,
            'payment_status' => $course->payment_status,
            'email' => $student_detail->email,
            'mobile' => $student_detail->mobile,
            'purchase_date' => now()->format('F d, Y'),
            'receipt_number' => $receipt_number,
            'category' => $category->category_name,
            'subcategory' => $subcategory->subcategory_name,
        ]);

        $pdf_content = $pdf->output();

        $relativePdfPath = 'Payment Receipt/' . Auth::user()->name . '_' . $course->course_name . '.pdf';

        // Ensure the directory exists
        if (!file_exists(public_path('Payment Receipt'))) {
            mkdir(public_path('Payment Receipt'), 0755, true);
        }

        // Save the generated PDF content to the public folder
        file_put_contents($relativePdfPath, $pdf_content);
    }
    public function privacy_policy()
    {
        return view('frontend.policies.privacy_policy');
    }
    public function terms()
    {
        return view('frontend.policies.term_conditions');
    }
    public function refund()
    {
        return view('frontend.policies.return_refund');
    }
}
