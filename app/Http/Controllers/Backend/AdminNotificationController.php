<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\image_resize_helper;
use App\Http\Controllers\Controller;
use App\Mail\AdminNotification;
use App\Models\Backend\Adminnotifiy;
use App\Models\Backend\Category;
use App\Models\Backend\Soldcourse;
use App\Models\Backend\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('backend.admin_notification.create', compact('category'));
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
            'message' => ['required'],
            'attachment' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();

        if ($request->hasFile('attachment')) {

            $attachment = time() . 'attachment' . '.' . $request->attachment->extension();

            $request->attachment->move(public_path('Admin Notification'), $attachment);

            image_resize_helper::resizeImage(public_path('Admin Notification/' . $attachment), 500, 500);

            $data['attachment'] = $attachment;
        }
        Adminnotifiy::create($data);

        $attachmentPath = trim(public_path('Admin Notification/' . $attachment));
        $user_detail = Student::get();
        foreach ($user_detail as $item) {
            try {
                Mail::to($item->email)->send(new AdminNotification(
                    $item->name,
                    $item->email,
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
