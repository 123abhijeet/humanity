<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Course;
use App\Models\Backend\Subcategory;
use App\Models\Teacher\Quiz;
use App\Models\Teacher\Test;
use App\Models\Teacher\Testquestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tests = Test::where('teacher_id', Auth::user()->id)->get();
        return view('backend.test.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $courses = Course::all();
        return view('backend.test.create', compact('category', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_category' => ['required'],
            'course_subcategory' => ['required'],
            'title' => ['required', Rule::unique('tests', 'title')],
            'subject' => ['required'],
            'total_questions' => ['required'],
            'total_time' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $test = Test::create([
            'teacher_id' => Auth::user()->id,
            'course_category' => $request->course_category,
            'course_subcategory' => $request->course_subcategory,
            'course' => $request->course,
            'title' => $request->title,
            'subject' => $request->subject,
            'total_questions' => $request->total_questions,
            'total_time' => $request->total_time,
            'type' => $request->type,
            'level' => $request->level,
        ]);
        if ($request->type == 'Objective') {
            foreach ($request->question as $key => $item) {
                Testquestion::create([
                    'test_id' => $test->id,
                    'question' => $item,
                    'option_a' => $request->option_a[$key],
                    'option_b' => $request->option_b[$key],
                    'option_c' => $request->option_c[$key],
                    'option_d' => $request->option_d[$key],
                    'answer' => $request->answer[$key],
                ]);
            }
        } else {
            foreach ($request->question as $key => $item) {
                Testquestion::create([
                    'test_id' => $test->id,
                    'question' => $item,
                ]);
            }
        }
        return redirect()->route('tests.index')->with('success', 'Data Stored Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        $category = Category::where('id', $test->course_category)->first();
        $subcategory = Subcategory::where('id', $test->course_subcategory)->first();
        $course = Course::where('id', $test->course)->first();
        $test_questions = Testquestion::where('test_id', $test->id)->get();
        return view('backend.test.view', compact('test', 'course', 'category', 'subcategory', 'test_questions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        $category = Category::all();
        $subcategory = Subcategory::where('id', $test->course_subcategory)->first();
        $test_questions = Testquestion::where('test_id', $test->id)->get();
        $course = Course::where('id', $test->course)->first();
        return view('backend.test.edit', ['test' => $test, 'course' => $course, 'test_questions' => $test_questions, 'category' => $category, 'subcategory' => $subcategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        $validator = Validator::make($request->all(), [
            'course_category' => ['required'],
            'course_subcategory' => ['required'],
            'title' => ['required'],
            'subject' => ['required'],
            'total_time' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Test::where('id',$test->id)->update([
            'course_category' => $request->course_category,
            'course_subcategory' => $request->course_subcategory,
            'course' => $request->course,
            'title' => $request->title,
            'subject' => $request->subject,
            'total_time' => $request->total_time,
            'level' => $request->level,
        ]);
        return redirect()->route('tests.index')->with('success', 'Data Stored Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        Testquestion::where('test_id', $test->id)->delete();
        $test->delete();
        return redirect()->route('tests.index')->with('error', 'Data Removed Successfully');
    }
}
