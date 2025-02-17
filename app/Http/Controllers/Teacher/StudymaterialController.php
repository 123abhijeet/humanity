<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Course;
use App\Models\Backend\Subcategory;
use App\Models\Teacher\Studymaterial;
use App\Models\Teacher\Studymaterialitem;
use App\Models\Teacher\Studymaterialtype;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudymaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studymaterials = Studymaterial::where('teacher_id', Auth::user()->id)->get();
        return view('backend.studymaterial.index', compact('studymaterials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $courses = Course::all();
        $types = Studymaterialtype::all();
        return view('backend.studymaterial.create', compact('category', 'courses', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'course_category' => ['required'],
                'course_subcategory' => ['required'],
                'course' => ['required'],
                'type' => ['required'],
                'title' => ['required'],
                'subject' => ['required'],
                'total_chapters' => ['required']
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $studymaterial = Studymaterial::create([
                'teacher_id' => Auth::user()->id,
                'course_category' => $request->course_category,
                'course_subcategory' => $request->course_subcategory,
                'course' => $request->course,
                'type' => $request->type,
                'title' => $request->title,
                'subject' => $request->subject,
                'total_chapters' => $request->total_chapters
            ]);
            foreach ($request->chapter as $key => $item) {
                $pdf = time() . '_' . uniqid(mt_rand(), true) . '_pdf.' . $request->pdf[$key]->extension();
                // Move the pdf file to the desired location
                $request->pdf[$key]->move(public_path('Study Material'), $pdf);
                Studymaterialitem::create([
                    'studymaterial_id' => $studymaterial->id,
                    'course' => $request->course,
                    'type' => $request->type,
                    'chapter' => $item,
                    'pdf' => $pdf, // Save the PDF file name directly
                ]);
            }

            return redirect()->route('studymaterials.index')->with('success', 'Data Stored Successfully');
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
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
    public function edit(Studymaterial $studymaterial)
    {
        $category = Category::all();
        $subcategory = Subcategory::where('id', $studymaterial->course_subcategory)->first();
        $course = Course::where('id', $studymaterial->course)->first();
        $types = Studymaterialtype::all();
        $studymaterial_item = Studymaterialitem::where('studymaterial_id', $studymaterial->id)->get();
        return view(
            'backend.studymaterial.edit',
            [
                'studymaterial_item' => $studymaterial_item,
                'studymaterial' => $studymaterial,
                'types' => $types,
                'course' => $course,
                'category' => $category,
                'subcategory' => $subcategory
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Studymaterial $studymaterial)
    {
        try {
            $validator = Validator::make($request->all(), [
                'course_category' => ['required'],
                'course_subcategory' => ['required'],
                'course' => ['required'],
                'type' => ['required'],
                'title' => ['required'],
                'subject' => ['required'],
                'total_chapters' => ['required']
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            Studymaterial::where('id', $studymaterial->id)->update([
                'course_category' => $request->course_category,
                'course_subcategory' => $request->course_subcategory,
                'course' => $request->course,
                'type' => $request->type,
                'title' => $request->title,
                'subject' => $request->subject,
            ]);
            Studymaterialitem::where('studymaterial_id', $studymaterial->id)->update([
                'course' => $request->course,
                'type' => $request->type
            ]);
            return redirect()->route('studymaterials.index')->with('success', 'Data Updated Successfully');
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
    public function destroy(Studymaterial $studymaterial)
    {
        $studymaterial_items = Studymaterialitem::where('studymaterial_id', $studymaterial->id)->get();
        foreach ($studymaterial_items as $detail) {
            if ($detail->pdf) {
                unlink(public_path('Study Material') . '/' . $detail->pdf);
            }
            $detail->delete();
        }
        $studymaterial->delete();
        return redirect()->route('studymaterials.index')->with('error', 'Data Removed Successfully');
    }
}
