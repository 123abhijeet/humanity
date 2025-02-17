<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Course;
use App\Models\Backend\Courserr;
use App\Models\Backend\Teacherrr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewRatingController extends Controller
{
    public function course_review_rating($id)
    {
        $course_reviews = Courserr::join('users', 'courserrs.student_id', 'users.id')
            ->join('students', 'users.email', 'students.email')
            ->where('courserrs.course_id', $id)
            ->where('courserrs.status', 1)
            ->select('users.name', 'students.picture as picture', 'courserrs.review', 'courserrs.rating', 'courserrs.updated_at')
            ->get();

        // Iterate through each subject and prepend the base URL to the course_banner field
        $course_reviews->transform(function ($course) {
            $course->picture = asset('Student Picture/' . $course->picture);
            return $course;
        });

        foreach ($course_reviews as $review) {
            $review->uploaded_on = Carbon::parse($review->updated_at)->diffForHumans();
            unset($review->updated_at);
        }

        return response()->json(['course_reviews' => $course_reviews]);
    }
    public function store_course_rating_review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "course_id" => "required",
            "review" => "required",
            "rating" => "required",
        ]);

      if ($validator->fails()) {
				return response()->json([
					"status" => false,
					"message" => "All Fields are Required",
					"error" => $validator->getMessageBag()->toArray()
				], 200);
      }else{
        $student_id = Auth::user()->id;
        $course_id = $request->input('course_id');

        // Check if the student has already submitted a review for this course
        $existingReview = Courserr::where('student_id', $student_id)
            ->where('course_id', $course_id)
            ->first();

        if ($existingReview) {
            return response()->json(["status" => false, 'message' => 'You have already submitted a review for this course.'], 200);
        }

        // Retrieve course details
        $course = Course::where('id', $course_id)->first();
        if (!$course) {
            return response()->json(['error' => 'Course not found.'], 404);
        }

        // Prepare data for insertion
        $data = $request->all();
        $data['student_id'] = $student_id;
        $data['teacher_id'] = $course->teacher_id;

        // Create the new review record
        Courserr::create($data);

        return response()->json(['message' => 'Data Submitted Successfully']);
      }

    }

    public function teacher_review_rating($id)
    {
        $teacher_reviews = Teacherrr::join('users', 'teacherrrs.student_id', 'users.id')
            ->join('students', 'users.email', 'students.email')
            ->where('teacherrrs.teacher_id', $id)
            ->where('teacherrrs.status', 1)
            ->select('users.name', 'students.picture as picture', 'teacherrrs.review', 'teacherrrs.rating', 'teacherrrs.updated_at')
            ->get();

        $teacher_reviews->transform(function ($course) {
            $course->picture = asset('Student Picture/' . $course->picture);
            return $course;
        });
        foreach ($teacher_reviews as $review) {
            $review->uploaded_on = Carbon::parse($review->updated_at)->diffForHumans();
            unset($review->updated_at);
        }

        return response()->json(['teacher_reviews' => $teacher_reviews]);
    }
    public function store_teacher_rating_review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "teacher_id" => "required",
            "review" => "required",
            "rating" => "required",
        ]);

      
      if ($validator->fails()) {
				return response()->json([
					"status" => false,
					"message" => "All Fields are Required",
					"error" => $validator->getMessageBag()->toArray()
				], 200);
      }else{

        $student_id = Auth::user()->id;
        $teacher_id = $request->input('teacher_id');

        // Check if the student has already submitted a review for this teacher
        $existingReview = Teacherrr::where('student_id', $student_id)
            ->where('teacher_id', $teacher_id)
            ->first();

        if ($existingReview) {
            return response()->json(["status" => false, 'message' => 'You have already submitted a review for this teacher.'], 200);
        }

        $data = $request->all();
        $data['student_id'] = $student_id;
        Teacherrr::create($data);

        return response()->json(["status" => true,'message' => 'Data Submitted Successfully']);
        }
    }
}
