<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Backend\Course;
use App\Models\Teacher\Query;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('Admin')) {
            $queries = Query::orderBy('id', 'desc')->get();
        } else {
            $queries = Query::where('teacher_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        }
        return view('backend.query.index', compact('queries'));
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
    public function edit(Query $query)
    {
        $course = Course::where('id', $query->course_id)->first();
        $student = User::where('id', $query->student_id)->first();
        return view('backend.query.edit', compact('query', 'course', 'student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Query $query)
    {
        $validator = Validator::make($request->all(), [
            'answer' => ['required', 'max:' . PHP_INT_MAX]
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Query::where('id', $query->id)->update([
            'answer' => $request->answer,
            'status' => 'Solved'
        ]);
        return redirect()->route('queries.index')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
