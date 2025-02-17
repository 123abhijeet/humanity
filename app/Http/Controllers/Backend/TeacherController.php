<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\UserRegistered;
use App\Models\Backend\Category;
use App\Models\Backend\Subcategory;
use App\Models\Backend\Teacher;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = Teacher::all();
        return view('backend.teacher.index', compact('teacher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('backend.teacher.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_category' => ['required'],
            'course_subcategory' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('teachers', 'email')],
            'mobile' => ['required', Rule::unique('teachers', 'mobile')],
            'qualification' => ['required', 'string', 'max:255'],
            'experience' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'picture' => ['required', 'max:500'], // Maximum size in kilobytes
            'identity_proof' => ['required', 'max:200'], // Maximum size in kilobytes
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        if ($request->picture) {
            $picture = time() . 'picture' . '.' . $request->picture->extension();
            $request->picture->move(public_path('Teacher Picture'), $picture);
            $data['picture'] = $picture;
        }
        if ($request->identity_proof) {
            $identity_proof = time() . 'identity_proof' . '.' . $request->identity_proof->extension();
            $request->identity_proof->move(public_path('Identity Proof'), $identity_proof);
            $data['identity_proof'] = $identity_proof;
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->mobile)
        ]);
        $data['user_id'] = $user->id;
        Teacher::create($data);
        try {
            Mail::to($user->email)->send(new UserRegistered($user->name, $user->email, $request->mobile));
        } catch (Exception $exception) {
            \Log::error('Mail sending error: ' . $exception->getMessage());
        }
        $user->assignRole('Teacher');
        return redirect()->route('teachers.index')->with('success', 'Data Stored Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        $category = Category::all();
        $subcategory = Subcategory::where('category_id', $teacher->course_category)->get();
        return view('backend.teacher.view', ['teacher' => $teacher, 'category' => $category, 'subcategory' => $subcategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        $category = Category::all();
        $subcategory = Subcategory::where('category_id', $teacher->course_category)->get();
        return view('backend.teacher.edit', ['teacher' => $teacher, 'category' => $category, 'subcategory' => $subcategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'qualification' => ['required', 'string', 'max:255'],
            'experience' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'The name field is required.',
            'qualification.required' => 'The qualification field is required.',
            'experience.required' => 'The experience field is required.',
            'address.required' => 'The address field is required.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $current_picture = Teacher::findOrFail($teacher->id)->picture;
        $current_identity_proof = Teacher::findOrFail($teacher->id)->identity_proof;

        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            $picture = time() . 'picture' . '.' . $request->picture->extension();
            $request->picture->move(public_path('Teacher Picture'), $picture);
            $data['picture'] = $picture;
            if ($current_picture) {
                unlink(public_path('Teacher Picture') . '/' . $current_picture);
            }
        } else {
            $picture = $current_picture;
            $data['picture'] = $picture;
        }
        if ($request->hasFile('identity_proof') && $request->file('identity_proof')->isValid()) {
            $identity_proof = time() . 'identity_proof' . '.' . $request->identity_proof->extension();
            $request->identity_proof->move(public_path('Identity Proof'), $identity_proof);
            $data['identity_proof'] = $identity_proof;
            if ($current_identity_proof) {
                unlink(public_path('Identity Proof') . '/' . $current_identity_proof);
            }
        } else {
            $identity_proof = $current_identity_proof;
            $data['identity_proof'] = $identity_proof;
        }
        $teacher->update($data);
        return redirect()->route('teachers.index')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $current_picture = Teacher::findOrFail($teacher->id)->picture;
        $current_identity_proof = Teacher::findOrFail($teacher->id)->identity_proof;
        if ($current_picture) {
            unlink(public_path('Teacher Picture') . '/' . $current_picture);
        }
        if ($current_identity_proof) {
            unlink(public_path('Identity Proof') . '/' . $current_identity_proof);
        }
        User::where('id', $teacher->user_id)->delete();
        $teacher->delete();
        return redirect()->route('teachers.index')->with('error', 'Data Removed Successfully');
    }
    public function update_teacher_status(Request $request)
    {
        User::where('id', $request->userId)->update([
            'status' => $request->status
        ]);
        return response()->json(['message' => 'Status Updated Successfully']);
    }
}
