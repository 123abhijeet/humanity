<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Course;
use App\Models\Teacher\Coursevideo;
use App\Models\Teacher\Coursevideoitem;
use App\Models\Teacher\Videoviewedtime;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CourseVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function get_curriculum($course_id)
    {
        $baseURL = url('/');
        $curriculumData = Coursevideo::join('coursevideoitems', 'coursevideos.id', '=', 'coursevideoitems.course_video_id')
            ->where('coursevideos.course', $course_id)
            ->select('coursevideos.section', 'coursevideos.total_duration', 'coursevideoitems.id', 'coursevideoitems.title', 'coursevideoitems.duration', 'coursevideoitems.video')
            ->get();

        $curriculum = [];

        foreach ($curriculumData as $item) {
            $sectionTitle = $item->section;

            // If the section doesn't exist, create it
            if (!isset($curriculum[$sectionTitle])) {
                $curriculum[$sectionTitle] = [
                    'section_title' => $sectionTitle,
                    'total_duration' => 0, // Initialize total duration in seconds
                    'videos' => []
                ];
            }

            // Convert duration to seconds
            $durationParts = explode(':', $item->duration);
            if (count($durationParts) == 3) {
                $seconds = intval($durationParts[0]) * 3600 + intval($durationParts[1]) * 60 + intval($durationParts[2]); // HH:MM:SS
            } elseif (count($durationParts) == 2) {
                $seconds = intval($durationParts[0]) * 60 + intval($durationParts[1]); // MM:SS
            } else {
                $seconds = intval($item->duration); // Directly use seconds if already in correct format
            }

            // Format duration as "HH:MM:SS"
            $formatted_duration = gmdate('H:i:s', $seconds);

            // Add video to the section
            $curriculum[$sectionTitle]['videos'][] = [
                'video_id' => $item->id,
                'title' => $item->title,
                'duration' => gmdate('i\m s\s', $seconds), // Format duration as "10m 30s"
                'video' => $baseURL . '/' . $item->video,
            ];

            // Accumulate total duration in seconds
            $curriculum[$sectionTitle]['total_duration'] += $seconds;
        }

        // Format the total durations
        foreach ($curriculum as &$section) {
            $hours = floor($section['total_duration'] / 3600); // Calculate hours
            $minutes = floor(($section['total_duration'] % 3600) / 60); // Calculate remaining minutes
            $seconds = $section['total_duration'] % 60; // Calculate remaining seconds
            $section['total_duration'] = '';

            if ($hours > 0) {
                $section['total_duration'] .= $hours . 'h ';
            }
            if ($minutes > 0) {
                $section['total_duration'] .= $minutes . 'm ';
            }
            if ($seconds > 0 || empty($section['total_duration'])) {
                $section['total_duration'] .= $seconds . 's';
            }
        }

        // Re-index the array to ensure JSON response is well-formed
        $curriculum = array_values($curriculum);

        return response()->json(['curriculum' => $curriculum]);
    }



    public function store_last_viewed_time(Request $request, $video_id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "viewed_time" => "required"
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Invalid Inputs",
                    "error" => $validator->getMessageBag()->toArray()
                ], 401);
            } else {
                $existingRecord = Videoviewedtime::where('student_id', Auth::user()->id)
                    ->where('video_id', $video_id)
                    ->first();

                if ($existingRecord) {
                    $newTimeInSeconds = $this->timeToSeconds($request->viewed_time);
                    $existingTimeInSeconds = $this->timeToSeconds($existingRecord->viewed_time);

                    if ($newTimeInSeconds > $existingTimeInSeconds) {
                        $existingRecord->update(['viewed_time' => $request->viewed_time]);
                        return response()->json(['Message' => 'Last viewed time updated successfully']);
                    } else {
                        return response()->json(['Message' => 'New viewed time is not greater than the previous time. No update made.']);
                    }
                } else {
                    $course_video_item = Coursevideoitem::where('id', $video_id)->first();
                    Videoviewedtime::create([
                        'student_id' => Auth::user()->id,
                        'course_video_id' => $course_video_item->course_video_id,
                        'video_id' => $video_id,
                        'viewed_time' => $request->viewed_time
                    ]);
                    return response()->json(['Message' => 'Last viewed time stored successfully']);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function check_resume_video()
    {
        $resume_course_video = Videoviewedtime::where('student_id', Auth::user()->id)->first();
        if (!$resume_course_video) {
            return response()->json(["status" => false, "message" => "No Data Found"]);
        }
    }
    public function resume_course_video()
    {
        try {
            $baseURL = url('/');

            $resume_course_video = Videoviewedtime::where('student_id', Auth::user()->id)->latest()->first();

            if (!$resume_course_video) {
                return response()->json(["course_details" => (object)[]]);
            }

            $course_video_data = Coursevideoitem::where('id', $resume_course_video->video_id)->first();
            $course_video = Coursevideo::where('id', $course_video_data->course_video_id)->first();

            $video_url = $baseURL . '/' . $course_video_data->video;

            $course_details = Course::join('teachers', 'courses.teacher_id', 'teachers.user_id')
                ->where('courses.id', $course_video_data->course_id)
                ->select('courses.id as course_id', 'courses.course_name', 'courses.course_banner', 'teachers.name as teachers_name')
                ->first();

            // Convert course_banner to a full URL
            $course_details->course_banner = asset('Course Banner/' . $course_details->course_banner);

            // Calculate the total viewed time across all videos within the same course_video_id
            $total_viewed_time_seconds = Videoviewedtime::where('course_video_id', $course_video_data->course_video_id)
                ->where('student_id', Auth::user()->id)
                ->sum(DB::raw("TIME_TO_SEC(viewed_time)"));

            // Calculate the viewed percentage
            $duration_seconds = $this->timeToSeconds($course_video->total_duration);
            $viewed_percentage = $duration_seconds > 0 ? round(($total_viewed_time_seconds / $duration_seconds) * 100) : 0;
            $viewed_percentage = min($viewed_percentage, 100); // Cap at 100%

            // Add the additional fields to the course details
            $course_details->video_url = $video_url;
            $course_details->video_id = $resume_course_video->video_id;
            $course_details->title = $course_video_data->title;
            $course_details->viewed_time = $resume_course_video->viewed_time;
            $course_details->duration = $course_video_data->duration;
            $course_details->viewed_percentage = $viewed_percentage . '% Complete';

            return response()->json(['course_details' => $course_details]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    // Helper function to convert time format HH:MM:SS to seconds
    private function timeToSeconds($time)
    {
        $parts = explode(':', $time);
        return ($parts[0] * 3600) + ($parts[1] * 60) + $parts[2];
    }
}
