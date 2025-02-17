<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\image_resize_helper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Course;
use App\Models\Backend\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get_subcategories($category_id)
    {
        $subcategory_details = Subcategory::where('category_id', $category_id)->get();
        return response()->json($subcategory_details);
    }
    public function get_courses_by_subcategory($subcategoryId)
    {
        $courses = Course::where('course_subcategory', $subcategoryId)->get();
        return response()->json($courses);
    }
    public function index()
    {
        $course = Course::where('teacher_id', Auth::user()->id)->get();
        return view('backend.course.index', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('backend.course.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), [
            'course_category' => ['required'],
            'course_subcategory' => ['required'],
            'course_name' => ['required', 'string', 'max:255', Rule::unique('courses', 'course_name')],
            'course_duration' => ['required', 'string', 'max:255'],
            'course_fee' => ['required'],
            'course_short_description' => ['required', 'string', 'max:255'],
            'course_description' => ['required', 'string', 'max:4000'],
            'course_banner' => ['required'], // Maximum size in kilobytes
            'course_video' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $videoFile = $request->file('course_video');
        $videoFileName = time() . '_course_intro_video' . '.' . $videoFile->getClientOriginalExtension();
        $videoFile->move(public_path('Course Intro Video'), $videoFileName); // Assuming you store videos in 'public/Course Video' directory
        $data['course_video'] = 'Course Intro Video/' . $videoFileName;

        if ($request->hasFile('course_banner')) {

            $course_banner = time() . 'course_banner' . '.' . $request->course_banner->extension();

            $request->course_banner->move(public_path('Course Banner'), $course_banner);

            image_resize_helper::resizeImage(public_path('Course Banner/' . $course_banner), 600, 400);

            $data['course_banner'] = $course_banner;
        }

        $data['teacher_id'] = Auth::user()->id;
        Course::create($data);
        return redirect()->route('courses.index')->with('success', 'Data Stored Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $category = Category::all();
        $subcategory = Subcategory::where('category_id', $course->course_category)->get();
        return view('backend.course.view', ['course' => $course, 'category' => $category, 'subcategory' => $subcategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $category = Category::all();
        $subcategory = Subcategory::where('category_id', $course->course_category)->get();
        return view('backend.course.edit', ['course' => $course, 'category' => $category, 'subcategory' => $subcategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), [
            'course_name' => ['required', 'string', 'max:255'],
            'course_duration' => ['required', 'string', 'max:255'],
            'course_fee' => ['required'],
            'course_short_description' => ['required', 'string', 'max:255'],
            'course_description' => ['required', 'string', 'max:4000']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $current_course_banner = Course::findOrFail($course->id)->course_banner;
        $current_course_video = Course::findOrFail($course->id)->course_video;

        if ($request->hasFile('course_banner') && $request->file('course_banner')->isValid()) {
            $course_banner = time() . 'course_banner' . '.' . $request->course_banner->extension();
            $request->course_banner->move(public_path('Course Banner'), $course_banner);
            image_resize_helper::resizeImage(public_path('Course Banner/' . $course_banner), 600, 400);
            $data['course_banner'] = $course_banner;

            if ($current_course_banner) {
                if (file_exists(public_path('Course Banner/' . $current_course_banner))) {
                    unlink(public_path('Course Banner/' . $current_course_banner));
                }
            }

            $data['course_banner'] = $course_banner;
        } else {
            $course_banner = $current_course_banner;
            $data['course_banner'] = $course_banner;
        }

        if ($request->hasFile('course_video') && $request->file('course_video')->isValid()) {
            $videoFile = $request->file('course_video');
            $videoFileName = time() . '_course_intro_video' . '.' . $videoFile->getClientOriginalExtension();
            $videoFile->move(public_path('Course Intro Video'), $videoFileName); // Assuming you store videos in 'public/Course Video' directory
            $data['course_video'] = 'Course Intro Video/' . $videoFileName;
            if ($current_course_video) {
                unlink(public_path() . '/' . $current_course_video);
            }
        } else {
            $videoFileName = $current_course_video;
            $data['course_video'] = 'Course Intro Video/' . $videoFileName;
        }
        $course->update($data);
        return redirect()->route('courses.index')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $current_course_banner = Course::findOrFail($course->id)->course_banner;
        $current_course_video = Course::findOrFail($course->id)->course_video;
        if ($current_course_banner) {
            unlink(public_path('Course Banner') . '/' . $current_course_banner);
        }
        if ($current_course_video) {
            unlink(public_path() . '/' . $current_course_video);
        }
        $course->delete();
        return redirect()->route('courses.index')->with('error', 'Data Removed Successfully');
    }
}
