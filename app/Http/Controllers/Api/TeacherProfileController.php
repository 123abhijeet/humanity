<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Course;
use App\Models\Backend\Courserr;
use App\Models\Backend\Soldcourse;
use App\Models\Backend\Subcategory;
use App\Models\Backend\Teacher;
use App\Models\Backend\Teacherrr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherProfileController extends Controller
{
    public function teacher_profile($id)
    {
        $teacher = Teacher::where('user_id', $id)->first();
        $teacher_rating_sum = Teacherrr::where('teacher_id', $id)->sum('rating');
        $number_of_ratings = Teacherrr::where('teacher_id', $id)->count();

        if ($number_of_ratings > 0) {
            $average_rating = $teacher_rating_sum / $number_of_ratings;
        } else {
            $average_rating = 0; // or any default value you prefer
        }

        if (!$teacher) {
            return response()->json(['error' => 'Teacher not found'], 404);
        }

        $courses = Course::join('subcategories', 'courses.course_subcategory', '=', 'subcategories.id')
            ->where('courses.teacher_id', $id)
            ->select('courses.id', 'courses.course_name', 'courses.course_fee', 'courses.subject', 'courses.course_banner', 'subcategories.subcategory_name')
            ->get();

        // Iterate through each teacher to calculate and append the average rating
        $courses->each(function ($course) {
            $course_rating_sum = Courserr::where('course_id', $course->id)->where('status', 1)->sum('rating');
            $number_of_ratings = Courserr::where('course_id', $course->id)->where('status', 1)->count();

            if ($number_of_ratings > 0) {
                $average_rating = $course_rating_sum / $number_of_ratings;
            } else {
                $average_rating = 0; // or any default value you prefer
            }

            $course->average_rating = $average_rating;
        });

        // Initialize courses array
        $formatted_courses = [];

        if (!$courses->isEmpty()) {
            // If courses found, format the data
            $formatted_courses = $courses->map(function ($course) {
                $course->course_banner = asset('Course Banner/' . $course->course_banner);
                $course->course_video_count = DB::table('coursevideos')
                    ->join('coursevideoitems', 'coursevideoitems.course_video_id', 'coursevideos.id')
                    ->where('coursevideos.course', $course->id)
                    ->count();
                return $course;
            });
        }

        $teacher_profile = [
            'teacher_name' => $teacher->name,
            'qualification' => $teacher->qualification,
            'subject' => $teacher->subject,
            'experience' => $teacher->experience,
            'average_rating' => $average_rating,
            'instructor_image' => asset('Teacher Picture/' . $teacher->picture),
            'courses' => $formatted_courses,
        ];

        return response()->json(['teacher_profile' => $teacher_profile]);
    }
    public function check_course_for_teacher($id)
    {
        $check = Soldcourse::where('teacher_id', $id)->where('student_id', auth()->user()->id)->count();
        return response()->json(['check' => $check]);
    }
    public function check_teacher_rating_status($id)
    {
        $check = Teacherrr::where('teacher_id', $id)->where('student_id', auth()->user()->id)->count();
        return response()->json(['check' => $check]);
    }
}
