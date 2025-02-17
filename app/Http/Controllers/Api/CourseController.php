<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Course;
use App\Models\Backend\CoursePayment;
use App\Models\Backend\Courserr;
use App\Models\Backend\Emipayment;
use App\Models\Backend\Offer;
use App\Models\Backend\Soldcourse;
use App\Models\Backend\Student;
use App\Models\Backend\Subcategory;
use App\Models\Backend\Teacher;
use App\Models\Teacher\Quiz;
use App\Models\Teacher\Teacherscoursepayment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\CoursePurchased;
use App\Models\Backend\Category;
use Barryvdh\DomPDF\Facade\Pdf;

class CourseController extends Controller
{
	public function search_course(Request $request)
	{
		$userEmail = Auth::user()->email;
		$user_details = Student::where('email', $userEmail)->first();

		$query = $request->input('query');

		$courses = Course::join('teachers', 'courses.teacher_id', 'teachers.user_id')
			->where('courses.course_name', 'like', '%' . $query . '%')
			->orWhere('courses.course_duration', 'like', '%' . $query . '%')
			->orWhere('courses.level', 'like', '%' . $query . '%')
			->orWhere('courses.course_fee', 'like', '%' . $query . '%')
			->where('courses.course_category', $user_details->category)->where('courses.course_subcategory', $user_details->subcategory)
			->select('courses.id as course_id', 'courses.course_name', 'courses.course_fee', 'courses.subject', 'courses.course_banner', 'teachers.name')
			->get();

		// Iterate through each teacher to calculate and append the average rating
		$courses->each(function ($course) {
			$course_rating_sum = Courserr::where('course_id', $course->course_id)->where('status', 1)->sum('rating');
			$number_of_ratings = Courserr::where('course_id', $course->course_id)->where('status', 1)->count();

			if ($number_of_ratings > 0) {
				$average_rating = $course_rating_sum / $number_of_ratings;
			} else {
				$average_rating = 0; // or any default value you prefer
			}

			$course->average_rating = $average_rating;
		});

		// Fetch course video items count for each course
		foreach ($courses as $course) {
			$course->course_video_count = DB::table('coursevideos')
				->join('coursevideoitems', 'coursevideoitems.course_video_id', 'coursevideos.id')
				->where('coursevideos.course', $course->course_id)
				->count();
		}

		// Iterate through each subject and prepend the base URL to the course_banner field
		$courses->transform(function ($course) {
			$course->course_banner = asset('Course Banner/' . $course->course_banner);
			return $course;
		});

		return response()->json(['courses' => $courses]);
	}
	public function get_courses()
	{
		try {
			$userEmail = Auth::user()->email;
			$user_details = Student::where('email', $userEmail)->first();

			$courses = Course::join('teachers', 'courses.teacher_id', 'teachers.user_id')
				->where('courses.course_category', $user_details->category)->where('courses.course_subcategory', $user_details->subcategory)
				->select('courses.id as course_id', 'courses.course_name', 'courses.course_fee', 'courses.subject', 'courses.course_banner', 'teachers.name')
				->get();

			// Iterate through each teacher to calculate and append the average rating
			$courses->each(function ($course) {
				$course_rating_sum = Courserr::where('course_id', $course->course_id)->where('status', 1)->sum('rating');
				$number_of_ratings = Courserr::where('course_id', $course->course_id)->where('status', 1)->count();

				if ($number_of_ratings > 0) {
					$average_rating = $course_rating_sum / $number_of_ratings;
				} else {
					$average_rating = 0; // or any default value you prefer
				}

				$course->average_rating = $average_rating;
			});
			// Fetch course video items count for each course
			foreach ($courses as $course) {
				$course->course_video_count = DB::table('coursevideos')
					->join('coursevideoitems', 'coursevideoitems.course_video_id', 'coursevideos.id')
					->where('coursevideos.course', $course->course_id)
					->count();
			}

			// Iterate through each subject and prepend the base URL to the course_banner field
			$courses->transform(function ($course) {
				$course->course_banner = asset('Course Banner/' . $course->course_banner);
				return $course;
			});
			return response()->json(['courses' => $courses]);
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "An error occurred.",
				"error" => $e->getMessage(),
			], 500);
		}
	}
	public function get_course_by_id($course_id)
	{
		try {
			$course_details = Course::join('subcategories', 'courses.course_subcategory', 'subcategories.id')
				->join('categories', 'courses.course_category', 'categories.id')
				->join('teachers', 'courses.teacher_id', 'teachers.user_id')
				->where('courses.id', $course_id)
				->select('categories.category_name', 'subcategories.subcategory_name', 'courses.course_video', 'courses.course_name', 'courses.level', 'courses.course_description', 'courses.course_banner', 'courses.course_fee', 'courses.course_duration', 'teachers.name as instructor', 'teachers.qualification', 'teachers.picture as instructor_image', 'teachers.user_id')
				->first();

			$course_rating_sum = Courserr::where('course_id', $course_id)->where('status', 1)->sum('rating');
			$number_of_ratings = Courserr::where('course_id', $course_id)->where('status', 1)->count();

			if ($number_of_ratings > 0) {
				$course_details->average_rating = $course_rating_sum / $number_of_ratings;
			} else {
				$course_details->average_rating = 0; // or any default value you prefer
			}

			// Fetch course video items count for each course
			$course_details->total_quiz = Quiz::where('course', $course_id)->count();


			if ($course_details->category_name != 'Class') {
				$course_details->access = 'Lifetime Access';

				$course_details->certificate =  'Certificate on Completion';
			}


			// Wrap $course_details in a collection and then transform
			$course_details = collect([$course_details])->transform(function ($course) {
				$course->course_video = asset($course->course_video);
				return $course;
			})->first();

			$course_details->course_video_count = DB::table('coursevideos')
				->join('coursevideoitems', 'coursevideoitems.course_video_id', 'coursevideos.id')
				->where('coursevideos.course', $course_id)
				->count();

			// Wrap $course_details in a collection and then transform
			$course_details = collect([$course_details])->transform(function ($course) {
				$course->course_banner = asset('Course Banner/' . $course->course_banner);
				return $course;
			})->first(); // Extract the transformed course details from the collection

			// Wrap $course_details in a collection and then transform
			$course_details = collect([$course_details])->transform(function ($teacher) {
				$teacher->instructor_image = asset('Teacher Picture/' . $teacher->instructor_image);
				return $teacher;
			})->first(); // Extract the transformed course details from the collection

			return response()->json(['course_details' => $course_details]);
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "An error occurred.",
				"error" => $e->getMessage(),
			], 500);
		}
	}
	public function get_recommended_courses()
	{
		try {
			$userEmail = Auth::user()->email;
			$user_details = Student::where('email', $userEmail)->first();

			$courses = Course::join('teachers', 'courses.teacher_id', 'teachers.user_id')
				->where('courses.course_category', $user_details->category)->where('courses.course_subcategory', $user_details->subcategory)
				->select('courses.id as course_id', 'courses.course_name', 'courses.course_fee', 'courses.subject', 'courses.course_banner', 'teachers.name')
				->take(3)
				->get();

			// Iterate through each teacher to calculate and append the average rating
			$courses->each(function ($course) {
				$course_rating_sum = Courserr::where('course_id', $course->course_id)->where('status', 1)->sum('rating');
				$number_of_ratings = Courserr::where('course_id', $course->course_id)->where('status', 1)->count();

				if ($number_of_ratings > 0) {
					$average_rating = $course_rating_sum / $number_of_ratings;
				} else {
					$average_rating = 0; // or any default value you prefer
				}

				$course->average_rating = $average_rating;
			});

			// Fetch course video items count for each course
			foreach ($courses as $course) {
				$course->course_video_count = DB::table('coursevideos')
					->join('coursevideoitems', 'coursevideoitems.course_video_id', 'coursevideos.id')
					->where('coursevideos.course', $course->course_id)
					->count();
			}

			// Iterate through each subject and prepend the base URL to the course_banner field
			$courses->transform(function ($course) {
				$course->course_banner = asset('Course Banner/' . $course->course_banner);
				return $course;
			});
			return response()->json(['courses' => $courses]);
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "An error occurred.",
				"error" => $e->getMessage(),
			], 500);
		}
	}
	public function course_payment(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				"course_id" => "required",
				"transaction_id" => "required",
				"payment_type"  => "required",
				"coupon_code" => "",
				"coupon_amount" => "",
				"amount_payable" => "",
				"payment_status" => "required"
			]);

			if ($validator->fails()) {
				return response()->json([
					"status" => false,
					"message" => "Invalid Inputs",
					"error" => $validator->getMessageBag()->toArray()
				], 401);
			} else {
				$course = Course::where('id', $request->course_id)->first();
				if ($request->payment_type == 'one_time') {
					CoursePayment::create([
						'course_id' => $request->course_id,
						'student_id' => Auth::user()->id,
						'teacher_id' => $course->teacher_id,
						'transaction_id' => $request->transaction_id,
						'name' => Auth::user()->name,
						'email' => Auth::user()->email,
						'amount' => $course->course_fee,
						'payment_type' => $request->payment_type,
						'coupon_code' => $request->coupon_code ? $request->coupon_code : null,
						'coupon_amount' => $request->coupon_amount ? $request->coupon_amount : null,
						'discounted_amount' => $request->amount_payable ? $request->amount_payable : null,
						'payment_status' => $request->payment_status
					]);
					Soldcourse::create([
						'teacher_id' => $course->teacher_id,
						'student_id' => Auth::user()->id,
						'course_id' => $request->course_id,
					]);
					Teacherscoursepayment::create([
						'teacher_id' => $course->teacher_id,
						'student_id' => Auth::user()->id,
						'course_id' => $request->course_id,
						'commission' => ($course->course_fee * 10) / 100,
						'payment_type' => $request->payment_type,
						'payment_status' => 'Pending'
					]);
				} else {
					$due_date = Carbon::now()->addDays(30)->toDateString();
					$installmentAmount = round(($course->course_fee + 1000) / 3, 2);
					$dueAmount = round(($course->course_fee + 1000) - (($course->course_fee + 1000) / 3), 2);
					$course_payment = CoursePayment::create([
						'course_id' => $request->course_id,
						'student_id' => Auth::user()->id,
						'teacher_id' => $course->teacher_id,
						'transaction_id' => $request->transaction_id,
						'name' => Auth::user()->name,
						'email' => Auth::user()->email,
						'amount' => $course->course_fee + 1000,
						'payment_type' => $request->payment_type,
						'installment_amount' => $installmentAmount,
						'due_date' => $due_date,
						'due_amount' => $dueAmount,
						'payment_status' => $request->payment_status
					]);
					Soldcourse::create([
						'teacher_id' => $course->teacher_id,
						'student_id' => Auth::user()->id,
						'course_id' => $request->course_id,
					]);
					$commission = round(($course_payment->installment_amount * 10) / 100, 2);
					Teacherscoursepayment::create([
						'teacher_id' => $course->teacher_id,
						'student_id' => Auth::user()->id,
						'course_id' => $request->course_id,
						'commission' => $commission,
						'due_date' => $due_date,
						'payment_type' => $request->payment_type,
						'payment_status' => 'Pending'
					]);
					$paidAmount = round($course_payment->installment_amount, 2);
					$dueAmount = round($course_payment->amount - $course_payment->installment_amount, 2);
					Emipayment::create([
						'course_payment_id' => $course_payment->id,
						'transaction_id' => $request->transaction_id,
						'paid_amount' => $paidAmount,
						'due_amount' => $dueAmount,
						'due_date' => $due_date,
						'payment_status' => $request->payment_status
					]);
				}
				$receipt_number = 'SAT' . date('dmY') . Auth::user()->id . $request->course_id;
				$student_detail = Student::where('email', Auth::user()->email)->first();
				$payment_detail = CoursePayment::where('course_id', $request->course_id)->where('student_id', Auth::user()->id)->first();
				$category = Category::where('id', $student_detail->category)->first();
				$subcategory = Subcategory::where('id', $student_detail->subcategory)->first();
				// Generate PDF

				$pdf = Pdf::loadView('payment_receipt', [
					'student_name' => Auth::user()->name,
					'course_name' => $course->course_name,
					'course_uid' => $course->course_uid,
					'course_fee' => $course->course_fee,
					'duration' => $course->course_duration,
					'amount' => $payment_detail->amount,
					'payment_type' => $payment_detail->payment_type,
					'payment_status' => $payment_detail->payment_status,
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

				CoursePayment::where('course_id', $request->course_id)->where('student_id', Auth::user()->id)->update([
					'payment_receipt' => $relativePdfPath
				]);

				try {
					Mail::to(Auth::user()->email)->send(new CoursePurchased(
						Auth::user()->name,
						Auth::user()->email,
						$course->course_name,
						public_path($relativePdfPath) // Pass the absolute path to the PDF
					));
				} catch (Exception $exception) {
					\Log::error('Mail sending error: ' . $exception->getMessage());
				}


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
	public function check_payment_status(Request $request)
	{
		$course_payment = CoursePayment::where('course_id', $request->course_id)->where('student_id', Auth::user()->id)->first();
		if ($course_payment) {
			if ($course_payment->due_amount > 0) {
				if ($course_payment->due_date <= Carbon::now()->toDateString()) {
					return response()->json(['message' => 'Next Installment Due!']);
				}
			}
			return response()->json(['message' => 'All Installment Cleared!']);
		} else {
			return response()->json(['message' => 'No data found!']);
		}
	}
	public function installment_order_details(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				"course_id" => "required",
			]);

			if ($validator->fails()) {
				return response()->json([
					"status" => false,
					"message" => "Invalid Inputs",
					"error" => $validator->getMessageBag()->toArray()
				], 401);
			} else {
				$course_payment = CoursePayment::where('course_id', $request->course_id)->where('student_id', Auth::user()->id)->first();
				$course_details = Course::where('id', $request->course_id)
					->select('course_name', 'course_banner', 'course_fee')
					->first();

				// Wrap $course_details in a collection and then transform
				$course_details = collect([$course_details])->transform(function ($course) {
					$course->course_banner = asset('Course Banner/' . $course->course_banner);
					return $course;
				})->first(); // Extract the transformed course details from the collection
				$course_details['course_fee'] = $course_details->course_fee + 1000;
				$course_details['amount_due'] =  $course_payment->due_amount;
				$course_details['sub_total'] =  $course_payment->due_amount;
				$course_details['amount_payable'] =  $course_payment->installment_amount;
				return response()->json(['course_details' => $course_details]);
			}
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "Something went wrong, try again.",
				"error" => $e->getMessage(),
			], 500);
		}
	}
	public function installment_payment(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				"course_id" => "required",
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

				$due_date = Carbon::now()->addDays(30)->toDateString();
				$course_payment = CoursePayment::where('course_id', $request->course_id)->where('student_id', Auth::user()->id)->first();
				$dueAmount = ceil($course_payment->due_amount - $course_payment->installment_amount);

				// Ensure due amount doesn't become negative
				$dueAmount = max(0, $dueAmount);

				CoursePayment::where('course_id', $request->course_id)->where('student_id', Auth::user()->id)->update([
					'due_date' => $due_date,
					'due_amount' => $dueAmount,
					'payment_status' => $request->payment_status
				]);
				$commission = ceil(($course_payment->installment_amount * 10) / 100);
				Teacherscoursepayment::create([
					'teacher_id' => $course_payment->teacher_id,
					'student_id' => Auth::user()->id,
					'course_id' => $request->course_id,
					'commission' => $commission,
					'due_date' => $due_date,
					'payment_type' => 'monthly',
					'payment_status' => 'Pending'
				]);
				Emipayment::create([
					'course_payment_id' => $course_payment->id,
					'transaction_id' => $request->transaction_id,
					'paid_amount' => $course_payment->installment_amount,
					'due_amount' => $dueAmount,
					'due_date' => $due_date,
					'payment_status' => $request->payment_status
				]);

				$receipt_number = 'SAT' . date('dmY') . Auth::user()->id . $request->course_id;
				$student_detail = Student::where('email', Auth::user()->email)->first();
				$payment_detail = CoursePayment::where('course_id', $request->course_id)->where('student_id', Auth::user()->id)->first();
				$category = Category::where('id', $student_detail->category)->first();
				$subcategory = Subcategory::where('id', $student_detail->subcategory)->first();
				$course = Course::where('id', $request->course_id)->first();
				// Generate PDF

				$pdf = Pdf::loadView('payment_receipt', [
					'student_name' => Auth::user()->name,
					'course_name' => $course->course_name,
					'course_uid' => $course->course_uid,
					'course_fee' => $course->course_fee,
					'duration' => $course->course_duration,
					'amount' => $payment_detail->amount,
					'payment_type' => $payment_detail->payment_type,
					'payment_status' => $payment_detail->payment_status,
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

				CoursePayment::where('course_id', $request->course_id)->where('student_id', Auth::user()->id)->update([
					'payment_receipt' => $relativePdfPath
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

	public function my_courses()
	{
		try {
			$courses = Course::join('soldcourses', 'courses.id', 'soldcourses.course_id')
				->join('teachers', 'courses.teacher_id', 'teachers.user_id')
				->where('soldcourses.student_id', Auth::user()->id)
				->select(
					'courses.id as course_id',
					'courses.course_name',
					'courses.subject',
					'courses.course_banner',
					'teachers.name as instructor',
					'soldcourses.created_at as purchase_date'
				)
				->get();

			// Iterate through each teacher to calculate and append the average rating
			$courses->each(function ($course) {
				$course_rating_sum = Courserr::where('course_id', $course->course_id)->where('status', 1)->sum('rating');
				$number_of_ratings = Courserr::where('course_id', $course->course_id)->where('status', 1)->count();

				if ($number_of_ratings > 0) {
					$average_rating = $course_rating_sum / $number_of_ratings;
				} else {
					$average_rating = 0; // or any default value you prefer
				}

				$course->average_rating = $average_rating;

				// Format the purchase_date
				$course->purchase_date = \Carbon\Carbon::parse($course->purchase_date)->format('F d, Y');
			});

			// Fetch course video items count for each course
			foreach ($courses as $course) {
				$course->course_video_count = DB::table('coursevideos')
					->join('coursevideoitems', 'coursevideoitems.course_video_id', 'coursevideos.id')
					->where('coursevideos.course', $course->course_id)
					->count();
			}

			$courses->transform(function ($course) {
				$course->course_banner = asset('Course Banner/' . $course->course_banner);
				return $course;
			});

			return response()->json(['courses' => $courses]);
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "An error occurred.",
				"error" => $e->getMessage(),
			], 500);
		}
	}

	public function my_course_details($course_id)
	{
		try {
			$course_details = Course::join('subcategories', 'courses.course_subcategory', 'subcategories.id')
				->join('categories', 'courses.course_category', 'categories.id')
				->join('teachers', 'courses.teacher_id', 'teachers.user_id')
				->where('courses.id', $course_id)
				->select('subcategories.subcategory_name', 'courses.course_video', 'courses.course_name', 'courses.level', 'courses.course_description', 'courses.course_banner', 'courses.course_duration', 'teachers.name as instructor', 'teachers.qualification', 'teachers.picture as instructor_image', 'teachers.user_id')
				->first();
			$course_rating_sum = Courserr::where('course_id', $course_id)->where('status', 1)->sum('rating');
			$number_of_ratings = Courserr::where('course_id', $course_id)->where('status', 1)->count();

			if ($number_of_ratings > 0) {
				$course_details->average_rating = $course_rating_sum / $number_of_ratings;
			} else {
				$course_details->average_rating = 0; // or any default value you prefer
			}

			$course_details->total_quiz = Quiz::where('course', $course_id)->count();

			if ($course_details->category_name != 'Class') {
				$course_details->access = 'Lifetime Access';

				$course_details->certificate =  'Certificate on Completion';
			}

			// Wrap $course_details in a collection and then transform
			$course_details = collect([$course_details])->transform(function ($course) {
				$course->course_video = asset($course->course_video);
				return $course;
			})->first();

			$course_details->course_video_count = DB::table('coursevideos')
				->join('coursevideoitems', 'coursevideoitems.course_video_id', 'coursevideos.id')
				->where('coursevideos.course', $course_id)
				->count();

			// Wrap $course_details in a collection and then transform
			$course_details = collect([$course_details])->transform(function ($course) {
				$course->course_banner = asset('Course Banner/' . $course->course_banner);
				return $course;
			})->first(); // Extract the transformed course details from the collection

			// Wrap $course_details in a collection and then transform
			$course_details = collect([$course_details])->transform(function ($teacher) {
				$teacher->instructor_image = asset('Teacher Picture/' . $teacher->instructor_image);
				return $teacher;
			})->first(); // Extract the transformed course details from the collection

			return response()->json(['course_details' => $course_details]);
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "An error occurred.",
				"error" => $e->getMessage(),
			], 500);
		}
	}
	public function course_purchase_status($id)
	{
		$check = Soldcourse::where('course_id', $id)->where('student_id', auth()->user()->id)->count();
		return response()->json(['check' => $check]);
	}
	public function payment_type(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				"course_id" => "required",
				"payment_type" => "required",
			]);

			if ($validator->fails()) {
				return response()->json([
					"status" => false,
					"message" => "Invalid Inputs",
					"error" => $validator->getMessageBag()->toArray()
				], 401);
			} else {
				if ($request->payment_type == 'one_time') {
					$course_details = Course::where('id', $request->course_id)
						->select('course_name', 'course_banner', 'course_fee')
						->first();

					// Wrap $course_details in a collection and then transform
					$course_details = collect([$course_details])->transform(function ($course) {
						$course->course_banner = asset('Course Banner/' . $course->course_banner);
						return $course;
					})->first(); // Extract the transformed course details from the collection
					if (!empty($request->coupon_code)) {
						$today = date('Y-m-d');

						$offer = Offer::where('offer_code', $request->coupon_code)
							->where('course_id', $request->course_id)
							->where('offer_type', 'course')
							->whereDate('start_date', '<=', $today)
							->whereDate('end_date', '>=', $today)
							->where('status', '1')
							->first();
						if ($offer) {
							$course_details['coupon_amount'] = $offer->offer_value;
							$course_details['amount_payable'] = round($course_details->course_fee - $offer->offer_value, 2);
							$course_details['coupon_code'] = $request->coupon_code;
							$course_details['sub_total'] =  $course_details->course_fee;
							return response()->json(["status" => true,	"message" => "Coupon Applied Sucessfully.", 'course_details' => $course_details], 200);
						} else {
							$course_details['amount_payable'] = $course_details->course_fee;
							$course_details['sub_total'] =  $course_details->course_fee;
							return response()->json(["status" => false,	"message" => "Coupon Doesn't Exists.", 'course_details' => $course_details], 200);
						}
					} else {
						$course_details['amount_payable'] = $course_details->course_fee;
						$course_details['sub_total'] =  $course_details->course_fee;
						return response()->json(['course_details' => $course_details]);
					}
				} else {
					$course_details = Course::where('id', $request->course_id)
						->select('course_name', 'course_banner', 'course_fee')
						->first();

					// Wrap $course_details in a collection and then transform
					$course_details = collect([$course_details])->transform(function ($course) {
						$course->course_banner = asset('Course Banner/' . $course->course_banner);
						return $course;
					})->first(); // Extract the transformed course details from the collection

					$course_details['sub_total'] =  $course_details->course_fee + 1000;
					$course_details['amount_payable'] = ceil($course_details['sub_total'] / 3);

					return response()->json(['course_details' => $course_details]);
				}
			}
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "An error occurred while Payment.",
				"error" => $e->getMessage(),
			], 500);
		}
	}
}
