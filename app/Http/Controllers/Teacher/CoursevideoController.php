<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Course;
use App\Models\Backend\Subcategory;
use App\Models\Teacher\Coursevideo;
use App\Models\Teacher\Coursevideoitem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CoursevideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course_video = Coursevideo::where('teacher_id', Auth::user()->id)->get();
        return view('backend.coursevideo.index', compact('course_video'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $courses = Course::all();
        return view('backend.coursevideo.create', compact('category', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'course_category' => ['required'],
    //             'course_subcategory' => ['required'],
    //             'course' => ['required'],
    //         ]);

    //         if ($validator->fails()) {
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }

    //         $course_video = Coursevideo::create([
    //             'teacher_id' => Auth::user()->id,
    //             'course_category' => $request->course_category,
    //             'course_subcategory' => $request->course_subcategory,
    //             'course' => $request->course,
    //             'section' => $request->section,
    //             'total_videos' => $request->total_videos
    //         ]);

    //         $total_duration_seconds = 0;

    //             $videoFile = $request->file('video');
    //             $videoFileName = time() . '_video_' . '.' . $videoFile->getClientOriginalExtension();
    //             $videoFile->move(public_path('Course Videos'), $videoFileName);

    //             $duration = $request->duration[$key];
    //             if (preg_match('/^(\d+):(\d+):(\d+)$/', $duration, $matches)) {
    //                 // Duration in "HH:MM:SS" format
    //                 $hours = (int) $matches[1];
    //                 $minutes = (int) $matches[2];
    //                 $seconds = (int) $matches[3];
    //             } elseif (preg_match('/^(\d+):(\d+)$/', $duration, $matches)) {
    //                 // Duration in "HH:MM" format
    //                 $hours = (int) $matches[1];
    //                 $minutes = (int) $matches[2];
    //                 $seconds = 0;
    //             } else {
    //                 // Assuming duration is in seconds
    //                 $total_seconds = (int) $duration;
    //                 $hours = floor($total_seconds / 3600);
    //                 $minutes = floor(($total_seconds % 3600) / 60);
    //                 $seconds = $total_seconds % 60;
    //             }

    //             // Format the duration as "HH:MM:SS"
    //             $formatted_duration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

    //             // Accumulate total duration in seconds
    //             $total_duration_seconds += $hours * 3600 + $minutes * 60 + $seconds;

    //             CourseVideoItem::create([
    //                 'course_video_id' => $course_video->id,
    //                 'course_id' => $request->course,
    //                 'title' => $item,
    //                 'duration' => $formatted_duration,
    //                 'video' => 'Course Videos/' . $videoFileName,
    //             ]);

    //         // Convert total duration to "HH:MM:SS" format
    //         $total_hours = floor($total_duration_seconds / 3600);
    //         $total_minutes = floor(($total_duration_seconds % 3600) / 60);
    //         $total_seconds = $total_duration_seconds % 60;
    //         $total_duration_formatted = sprintf('%02d:%02d:%02d', $total_hours, $total_minutes, $total_seconds);

    //         Coursevideo::where('id', $course_video->id)->update([
    //             'total_duration' => $total_duration_formatted
    //         ]);

    //         return redirect()->route('coursevideos.index')->with('success', 'Data Stored Successfully');
    //     } catch (Exception $e) {
    //         return response()->json([
    //             "status" => false,
    //             "message" => "An error occurred.",
    //             "error" => $e->getMessage(),
    //         ], 500);
    //     }
    // }


    /**
     * Display the specified resource.
     */
    public function show(Coursevideo $coursevideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coursevideo $coursevideo)
    {
        $category = Category::all();
        $subcategory = Subcategory::where('id', $coursevideo->course_subcategory)->first();
        $course = Course::where('id', $coursevideo->course)->first();
        $course_video_item = Coursevideoitem::where('course_video_id', $coursevideo->id)->get();
        return view('backend.coursevideo.edit', ['course_video_item' => $course_video_item, 'coursevideo' => $coursevideo, 'course' => $course, 'category' => $category, 'subcategory' => $subcategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coursevideo $coursevideo)
    {
        try {
            $validator = Validator::make($request->all(), [
                'course_category' => ['required'],
                'course_subcategory' => ['required'],
                'course' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            Coursevideo::where('id', $coursevideo->id)->update([
                'course_category' => $request->course_category,
                'course_subcategory' => $request->course_subcategory,
                'course' => $request->course,
                'section' => $request->section
            ]);
            CourseVideoItem::where('course_video_id', $coursevideo->id)->update([
                'course_id' => $request->course
            ]);
            return redirect()->route('coursevideos.index')->with('success', 'Data Stored Successfully');
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coursevideo $coursevideo)
    {
        $course_video_items = Coursevideoitem::where('course_video_id', $coursevideo->id)->get();
        foreach ($course_video_items as $detail) {
            if ($detail->video) {
                unlink(public_path() . '/' . $detail->video);
            }
            $detail->delete();
        }
        $coursevideo->delete();
        return redirect()->route('coursevideos.index')->with('error', 'Data Removed Successfully');
    }
    public function chunkedUpload(Request $request)
    {
        $chunkNumber = $request->input('chunk_number');
        $totalChunks = $request->input('total_chunks');
    
        $videoChunk = $request->file('video_chunk');
        $chunkFileName = 'video_chunk_' . $chunkNumber . '.part';
    
        // Store each chunk in the temporary storage
        $videoChunk->move(storage_path('app/chunks'), $chunkFileName);
    
        // Once all chunks are uploaded, merge them
        if ($chunkNumber == $totalChunks) {
            $fileName = 'final_video_' . time() . '.mp4'; // Final file name
            $finalFile = storage_path('app/chunks/') . $fileName;
    
            $outFile = fopen($finalFile, 'wb');
    
            for ($i = 1; $i <= $totalChunks; $i++) {
                $chunkPath = storage_path('app/chunks/video_chunk_' . $i . '.part');
                $inFile = fopen($chunkPath, 'rb');
                while ($buffer = fread($inFile, 4096)) {
                    fwrite($outFile, $buffer);
                }
                fclose($inFile);
                // Delete the chunk after appending
                unlink($chunkPath);
            }
            fclose($outFile);
    
            // Move the final merged video to public path
            $publicVideoPath = public_path('Course Videos/' . $fileName);
            rename($finalFile, $publicVideoPath); // Move the final file to public storage
    
            try {
                // Validate the single video request
                $validator = Validator::make($request->all(), [
                    'course_category' => ['required'],
                    'course_subcategory' => ['required'],
                    'course' => ['required'],
                    'title' => ['required'],
                    'duration' => ['required'], // Assuming duration is passed in the right format
                ]);
    
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
    
                // Create a new Coursevideo entry
                $course_video = Coursevideo::create([
                    'teacher_id' => Auth::user()->id,
                    'course_category' => $request->course_category,
                    'course_subcategory' => $request->course_subcategory,
                    'course' => $request->course,
                    'section' => $request->section,
                    'total_videos' => 1, // Only one video
                    'total_duration' => $request->duration, // Assuming duration is passed in the right format
                ]);
    
                // Handle the single video (merged final video)
                $videoFileName = $fileName;
    
                // Insert the video details into the CourseVideoItem
                CourseVideoItem::create([
                    'course_video_id' => $course_video->id,
                    'course_id' => $request->course,
                    'title' => $request->title, // Assuming you have a single title
                    'duration' => $request->duration,
                    'video' => 'Course Videos/' . $videoFileName,
                ]);
    
                return redirect()->route('coursevideos.index')->with('success', 'Data Stored Successfully');
            } catch (Exception $e) {
                return response()->json([
                    "status" => false,
                    "message" => "An error occurred.",
                    "error" => $e->getMessage(),
                ], 500);
            }
        }
    
        return response()->json(['status' => 'in_progress']);
    }
}
