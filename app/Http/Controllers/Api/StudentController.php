<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Backend\Subcategory;
use App\Models\Backend\Category;
use App\Models\Backend\Course;
use App\Models\Backend\Coursecertificate;
use App\Models\Backend\Courserr;
use App\Models\Backend\Offer;
use App\Models\Backend\Student;
use App\Models\Backend\Teacher;
use App\Models\Backend\Teacherrr;
use App\Models\Teacher\Query;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
	public function logo()
	{
		$logoPath = asset('frontend/img/sat_logo.png');

		return $logoPath;
	}
	public function get_subcategory_data()
	{
		$categories = Category::all();

		// Initialize an empty array to store the structured data
		$categoryData = [];

		// Loop through each category
		foreach ($categories as $category) {
			// Fetch subcategories for the current category
			$subcategories = Subcategory::where('category_id', $category->id)->get()->pluck('subcategory_name');

			// Add the category name and its subcategories to the structured data array
			$categoryData[] = [
				'category_name' => $category->category_name,
				'subcategories' => $subcategories,
			];
		}
		return response()->json($categoryData);
	}
	public function store_student_info(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				"name" => "required",
				"email" => "required",
				"mobile" => "required",
				"category" => "required",
				"subcategory" => "required",
			]);

			if ($validator->fails()) {
				return response()->json([
					"status" => false,
					"message" => "All Fields are Required",
					"error" => $validator->getMessageBag()->toArray()
				], 401);
			} else {
				$category = Category::where('category_name', $request->category)->first();
				$subcategory = Subcategory::where('subcategory_name', $request->subcategory)->first();
				Student::create([
					'name' => $request->name,
					'email' => $request->email,
					'mobile' => $request->mobile,
					'category' => $category->id,
					'subcategory' => $subcategory->id,
				]);
				User::where('email', $request->email)->update([
					'name' => $request->name,
				]);
				return response()->json([
					"status" => true,
					"message" => "Student Info Updated Sucessfully",
				], 201);
			}
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "An error occurred.",
				"error" => $e->getMessage(),
			], 500);
		}
	}
	public function get_teachers(Request $request)
	{
		try {
			$userEmail = Auth::user()->email;
			$user_details = Student::where('email', $userEmail)->first();

			$teachers = Teacher::where('course_category', $user_details->category)->where('course_subcategory', $user_details->subcategory)
				->select('id', 'user_id', 'name', 'experience', 'picture')
				->get();

			// Iterate through each teacher to calculate and append the average rating
			$teachers->each(function ($teacher) {
				$teacher_rating_sum = Teacherrr::where('teacher_id', $teacher->user_id)->where('status', 1)->sum('rating');
				$number_of_ratings = Teacherrr::where('teacher_id', $teacher->user_id)->where('status', 1)->count();
				// dd($number_of_ratings);

				if ($number_of_ratings > 0) {
					$average_rating = $teacher_rating_sum / $number_of_ratings;
				} else {
					$average_rating = 0; // or any default value you prefer
				}

				$teacher->average_rating = $average_rating;
			});
			// Iterate through each subject and prepend the base URL to the picture field
			$teachers->transform(function ($teacher) {
				$teacher->picture = asset('Teacher Picture/' . $teacher->picture);
				return $teacher;
			});
			return response()->json(['teachers' => $teachers]);
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "An error occurred.",
				"error" => $e->getMessage(),
			], 500);
		}
	}

	public function get_category()
	{
		try {
			$categories = Category::all();
			return response()->json(['categories' => $categories]);
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "An error occurred.",
				"error" => $e->getMessage(),
			], 500);
		}
	}
	public function get_subcategory($category_id)
	{
		try {
			$subcategories = Subcategory::where('category_id', $category_id)->get();
			return response()->json(['subcategories' => $subcategories]);
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "An error occurred.",
				"error" => $e->getMessage(),
			], 500);
		}
	}
	public function get_course_subjects()
	{
		$userEmail = Auth::user()->email;
		$user_details = Student::where('email', $userEmail)->first();
		$category = Category::where('id', $user_details->category)->first();
		if ($category->category_name == 'Class') {
			$subjects = Course::whereNotNull('subject')->distinct()->pluck('subject')->toArray();

			// Add "All Subjects" at the beginning of the subjects array
			array_unshift($subjects, "All Subjects");
		} else {
			$subjects = [];
		}
		return response()->json(['subjects' => $subjects]);
	}

	public function get_course_by_subjects(Request $request)
	{
		$userEmail = Auth::user()->email;
		$user_details = Student::where('email', $userEmail)->first();
		if ($request->subject) {
			if ($request->subject == 'All Subjects') {
				$subjects = Course::join('teachers', 'courses.teacher_id', 'teachers.user_id')
					->where('courses.course_category', $user_details->category)->where('courses.course_subcategory', $user_details->subcategory)
					->whereNotNull('courses.subject')
					->select('courses.id as course_id', 'courses.course_name', 'courses.course_fee', 'courses.subject', 'courses.course_banner', 'teachers.name')
					->get();

				// Fetch course video items count for each course
				foreach ($subjects as $course) {
					$course->course_video_count = DB::table('coursevideos')
						->join('coursevideoitems', 'coursevideoitems.course_video_id', 'coursevideos.id')
						->where('coursevideos.course', $course->course_id)
						->count();
				}

				// Iterate through each teacher to calculate and append the average rating
				$subjects->each(function ($course) {
					$course_rating_sum = Courserr::where('course_id', $course->course_id)->where('status', 1)->sum('rating');
					$number_of_ratings = Courserr::where('course_id', $course->course_id)->where('status', 1)->count();

					if ($number_of_ratings > 0) {
						$average_rating = $course_rating_sum / $number_of_ratings;
					} else {
						$average_rating = 0; // or any default value you prefer
					}

					$course->average_rating = $average_rating;
				});
				// Iterate through each subject and prepend the base URL to the course_banner field
				$subjects->transform(function ($subject) {
					$subject->course_banner = asset('Course Banner/' . $subject->course_banner);
					return $subject;
				});
			} else {
				$subjects = Course::join('teachers', 'courses.teacher_id', 'teachers.user_id')
					->where('courses.course_category', $user_details->category)->where('courses.course_subcategory', $user_details->subcategory)
					->where('courses.subject', $request->subject)
					->select('courses.id as course_id', 'courses.course_name', 'courses.course_fee', 'courses.subject', 'courses.course_banner', 'teachers.name')
					->get();

				// Fetch course video items count for each course
				foreach ($subjects as $course) {
					$course->course_video_count = DB::table('coursevideos')
						->join('coursevideoitems', 'coursevideoitems.course_video_id', 'coursevideos.id')
						->where('coursevideos.course', $course->course_id)
						->count();
				}

				// Iterate through each teacher to calculate and append the average rating
				$subjects->each(function ($course) {
					$course_rating_sum = Courserr::where('course_id', $course->course_id)->where('status', 1)->sum('rating');
					$number_of_ratings = Courserr::where('course_id', $course->course_id)->where('status', 1)->count();

					if ($number_of_ratings > 0) {
						$average_rating = $course_rating_sum / $number_of_ratings;
					} else {
						$average_rating = 0; // or any default value you prefer
					}

					$course->average_rating = $average_rating;
				});
				// Iterate through each subject and prepend the base URL to the course_banner field
				$subjects->transform(function ($subject) {
					$subject->course_banner = asset('Course Banner/' . $subject->course_banner);
					return $subject;
				});
			}
		} else {
			$subjects = Course::join('teachers', 'courses.teacher_id', 'teachers.user_id')
				->where('courses.course_category', $user_details->category)->where('courses.course_subcategory', $user_details->subcategory)
				->whereNotNull('courses.subject')
				->select('courses.id as course_id', 'courses.course_name', 'courses.course_fee', 'courses.subject', 'courses.course_banner', 'teachers.name')
				->get();

			// Fetch course video items count for each course
			foreach ($subjects as $course) {
				$course->course_video_count = DB::table('coursevideos')
					->join('coursevideoitems', 'coursevideoitems.course_video_id', 'coursevideos.id')
					->where('coursevideos.course', $course->course_id)
					->count();
			}

			// Iterate through each teacher to calculate and append the average rating
			$subjects->each(function ($course) {
				$course_rating_sum = Courserr::where('course_id', $course->course_id)->where('status', 1)->sum('rating');
				$number_of_ratings = Courserr::where('course_id', $course->course_id)->where('status', 1)->count();

				if ($number_of_ratings > 0) {
					$average_rating = $course_rating_sum / $number_of_ratings;
				} else {
					$average_rating = 0; // or any default value you prefer
				}

				$course->average_rating = $average_rating;
			});

			// Iterate through each subject and prepend the base URL to the course_banner field
			$subjects->transform(function ($subject) {
				$subject->course_banner = asset('Course Banner/' . $subject->course_banner);
				return $subject;
			});
		}
		return response()->json(['subjects' => $subjects]);
	}

	public function get_teachers_subjects()
	{
		$subjects = Teacher::where('subject', '!=', null)->get()->pluck('subject');
		return response()->json(['subjects' => $subjects]);
	}
	public function ask_question(Request $request)
	{
		try {
			$validator = Validator::make($request->all(), [
				"course_id" => "required"
			]);

			if ($validator->fails()) {
				return response()->json([
					"status" => false,
					"message" => "Invalid Inputs",
					"error" => $validator->getMessageBag()->toArray()
				], 401);
			} else {
				$question_image = '';
				$course = Course::where('id', $request->course_id)->pluck('teacher_id')->first();
				if ($request->hasFile('question_image') && $request->file('question_image')->isValid()) {
					$question_image = time() . 'question_image' . '.' . $request->question_image->extension();
					$request->question_image->move(public_path('Student Query'), $question_image);
				}

				Query::create([
					'teacher_id' => $course,
					'student_id' => Auth::user()->id,
					'course_id' => $request->course_id,
					'question_text' =>  $request->question_text ? $request->question_text : null,
					'question_image' => $question_image ? $question_image : null,
				]);
				return response()->json([
					"status" => true,
					"message" => "Question sent Successfully",
				], 201);
			}
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "An error occurred.",
				"error" => $e->getMessage(),
			], 500);
		}
	}
	public function all_asked_questions()
	{
		$asked_questions = Query::where('student_id', Auth::user()->id)->get();
		return response()->json(['asked_questions' => $asked_questions]);
	}
	public function asked_question_details($question_id)
	{
		$asked_question = Query::where('student_id', Auth::user()->id)
			->where('id', $question_id)
			->select('question_text', 'answer', 'question_image')
			->first();

		if (!empty($asked_question)) {
			if ($asked_question->question_image != '') {
				$asked_question->question_image = asset('Student Query/' . $asked_question->question_image);
			}

			// Check if the answer is an image
			if ($asked_question->answer != '' && pathinfo($asked_question->answer, PATHINFO_EXTENSION)) {
				$asked_question->answer = asset('Student Query/' . $asked_question->answer);
			}

			return response()->json(['asked_question' => $asked_question]);
		} else {
			return response()->json(['error' => 'Question not found'], 404);
		}
	}
	public function get_offers()
	{
		$userEmail = Auth::user()->email;
		$user_details = Student::where('email', $userEmail)->first();
		$offers = Offer::where('course_category', $user_details->category)
			->where('course_subcategory', $user_details->subcategory)
			->where('status', '1')
			->select('start_date', 'end_date', 'offer_banner')
			->get();
		$offers->transform(function ($offer) {
			$offer->start_date = Carbon::parse($offer->start_date)->translatedFormat('d F y');
			$offer->end_date = Carbon::parse($offer->end_date)->translatedFormat('d F y');
			$offer->offer_banner = asset($offer->offer_banner);
			return $offer;
		});
		return response()->json(['offers' => $offers]);
	}
	public function verify_course_coupon_code($code, $course_id)
	{
		$today = date('Y-m-d');

		$offer = Offer::where('offer_code', $code)
			->where('course_id', $course_id)
			->where('offer_type', 'course')
			->whereDate('start_date', '<=', $today)
			->whereDate('end_date', '>=', $today)
			->where('status', '1')
			->select('offer_value')
			->first();
		return response()->json(['offer' => $offer]);
	}
	public function verify_quiz_coupon_code($code, $quiz_id)
	{
		$today = date('Y-m-d');

		$offer = Offer::where('offer_code', $code)
			->where('quiz_id', $quiz_id)
			->where('offer_type', 'quiz')
			->whereDate('start_date', '<=', $today)
			->whereDate('end_date', '>=', $today)
			->where('status', '1')
			->select('offer_value')
			->first();
		return response()->json(['offer' => $offer]);
	}
	public function get_certificates()
	{
		try {
			$certificates = Coursecertificate::join('courses', 'coursecertificates.course_id', 'courses.id')
				->where('student_id', Auth::user()->id)
				->select('coursecertificates.id', 'courses.course_name', 'courses.subject', 'courses.course_banner', 'coursecertificates.certificate_issued_date')
				->get();

			$certificates->transform(function ($certificate) {
				$certificate->course_banner = asset('Course Banner/' . $certificate->course_banner);
				$certificate->certificate_issued_date = Carbon::parse($certificate->certificate_issued_date)->format('F d,Y');
				return $certificate;
			});

			return response()->json(['certificates' => $certificates]);
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "An error occurred.",
				"error" => $e->getMessage(),
			], 500);
		}
	}
	public function get_certificate_details($id)
	{
		try {
			$certificate = Coursecertificate::join('courses', 'coursecertificates.course_id', 'courses.id')
				->join('users', 'coursecertificates.student_id', 'users.id')
				->where('coursecertificates.id', $id)
				->select('coursecertificates.certificate_no', 'users.name as student_name','courses.id as course_id', 'courses.course_name as course_name', 'courses.subject', 'coursecertificates.course_issued_date as course_issued_date', 'coursecertificates.certificate_issued_date')
				->first();

			$certificate = collect([$certificate])->transform(function ($item) {
				$item->course_issued_date = Carbon::parse($item->course_issued_date)->format('F d,Y');
				$item->certificate_issued_date = Carbon::parse($item->certificate_issued_date)->format('F d,Y');
				return $item;
			})->first();

			return response()->json(['certificate' => $certificate]);
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => "An error occurred.",
				"error" => $e->getMessage(),
			], 500);
		}
	}

	public function download_certificate($course_id)
	{
		$certificate_detail = Coursecertificate::where('course_id', $course_id)->where('student_id', Auth::user()->id)->first();

		if ($certificate_detail->certificate != '') {
			$certificate_detail->certificate = asset($certificate_detail->certificate);
		}

		return response()->json(['certificate_detail' => $certificate_detail]);
	}
	public function generate_certificate($course_id)
	{
		$course_certificate_details = Coursecertificate::where('student_id', Auth::user()->id)->where('course_id', $course_id)->first();
		$course = Course::where('id', $course_id)->first();
		// Generate PDF
		$pdf = Pdf::loadView('certificate', [
			'student_name' => Auth::user()->name,
			'course_name' => $course->name,
			'course_start_date' => $course_certificate_details->created_at->format('Y-m-d'),
			'course_end_date' => Carbon::now()->format('Y-m-d'),
			'certificate_issued_date' => Carbon::now()->format('Y-m-d'),
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

		Coursecertificate::where('student_id', Auth::user()->id)->where('course_id', $course_id)->update([
			'certificate' => $relativePdfPath
		]);
	}
}
