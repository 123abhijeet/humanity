<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Subcategory;
use App\Models\Teacher\Quiz;
use App\Models\Teacher\Quizquestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizees = Quiz::where('teacher_id', Auth::user()->id)->get();
        return view('backend.quiz.index', compact('quizees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('backend.quiz.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_category' => ['required'],
            'course_subcategory' => ['required'],
            'course' => ['required'],
            'title' => ['required', Rule::unique('quizzes', 'title')],
            'subject' => ['required'],
            'total_questions' => ['required'],
            'total_time' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $quiz = Quiz::create([
            'teacher_id' => Auth::user()->id,
            'course_category' => $request->course_category,
            'course_subcategory' => $request->course_subcategory,
            'course' => $request->course,
            'title' => $request->title,
            'subject' => $request->subject,
            'total_questions' => $request->total_questions,
            'total_time' => $request->total_time,
            'level' => $request->level,
            'price' => $request->price,
            'attempt_date' => $request->attempt_date,
        ]);
        foreach ($request->question as $key => $item) {
            Quizquestion::create([
                'quiz_id' => $quiz->id,
                'question' => $item,
                'option_a' => $request->option_a[$key],
                'option_b' => $request->option_b[$key],
                'option_c' => $request->option_c[$key],
                'option_d' => $request->option_d[$key],
                'answer' => $request->answer[$key],
            ]);
        }
        return redirect()->route('quizzes.index')->with('success', 'Data Stored Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        $category = Category::where('id', $quiz->course_category)->first();
        $subcategory = Subcategory::where('id', $quiz->course_subcategory)->first();
        $quiz_questions = Quizquestion::where('quiz_id', $quiz->id)->get();
        return view('backend.quiz.view', compact('quiz', 'category', 'subcategory', 'quiz_questions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        $category = Category::all();
        $subcategory = Subcategory::where('id', $quiz->course_subcategory)->first();
        $quiz_questions = Quizquestion::where('quiz_id', $quiz->id)->get();
        return view('backend.quiz.edit', ['quiz' => $quiz, 'quiz_questions' => $quiz_questions, 'category' => $category, 'subcategory' => $subcategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $validator = Validator::make($request->all(), [
            'course_category' => ['required'],
            'course_subcategory' => ['required'],
            'course' => ['required'],
            'title' => ['required'],
            'subject' => ['required'],
            'total_questions' => ['required'],
            'total_time' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Quiz::where('id', $quiz->id)->update([
            'course_category' => $request->course_category,
            'course_subcategory' => $request->course_subcategory,
            'course' => $request->course,
            'title' => $request->title,
            'subject' => $request->subject,
            'total_time' => $request->total_time,
            'level' => $request->level,
            'price' => $request->price,
            'attempt_date' => $request->attempt_date
        ]);
        return redirect()->route('quizzes.index')->with('success', 'Data Stored Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        Quizquestion::where('quiz_id', $quiz->id)->delete();
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('error', 'Data Removed Successfully');
    }
    public function get_quiz_by_subcategory($subcategoryId)
    {
        $quiz = Quiz::where('course_subcategory', $subcategoryId)->whereNotNull('price')->get();
        return response()->json($quiz);
    }
}
