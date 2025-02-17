<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\image_resize_helper;
use App\Http\Controllers\Controller;
use App\Mail\TeacherNotification;
use App\Models\Backend\Category;
use App\Models\Backend\Soldcourse;
use App\Models\Teacher\Teachernotifiy;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class TeacherNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('backend.teacher_notification.create', compact('category'));
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
        $validator = Validator::make($request->all(), [
            'course_category' => ['required'],
            'course_subcategory' => ['required'],
            'course' => ['required'],
            'message' => ['required'],
            'attachment' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();

        if ($request->hasFile('attachment')) {

            $attachment = time() . 'attachment' . '.' . $request->attachment->extension();

            $request->attachment->move(public_path('Teacher Notification'), $attachment);

            image_resize_helper::resizeImage(public_path('Teacher Notification/' . $attachment), 500, 500);

            $data['attachment'] = $attachment;
        }
        Teachernotifiy::create($data);
        $student_detail = Soldcourse::where('course_id', $request->course)->get();

        $attachmentPath = trim(public_path('Teacher Notification/' . $attachment));
        foreach ($student_detail as $item) {
            $user_detail = User::where('id', $item->student_id)->first();
            try {
                Mail::to($user_detail->email)->send(new TeacherNotification(
                    $user_detail->name,
                    $user_detail->email,
                    $request->message,
                    $attachmentPath
                ));
            } catch (Exception $exception) {
                \Log::error('Mail sending error: ' . $exception->getMessage());
            }
        }
        return redirect()->back()->with('success', 'Sent');
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
}
