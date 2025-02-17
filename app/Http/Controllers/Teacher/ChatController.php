<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Student;
use App\Models\Backend\Teacher;
use App\Models\User;

class ChatController extends Controller
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
    public function all_chat_api($channel_name)
    {
        $all_chats = Chat::where('channel_name', $channel_name)->orderBy('created_at','desc')->select('user_id', 'message')->limit(4)->get();
        
        $all_chats->transform(function ($chat) {
            // Fetch the user's email from the User model
            $user = User::find($chat->user_id);
            
            if ($user) {
                // Fetch the student's details using the user's email
                $student = Student::where('email', $user->email)->first();
                
                if ($student) {
                    // Set user_name and user_avatar from the Student model
                    $chat->user_name = $student->name;
                    $chat->user_avatar = asset('Student Picture/' . $student->picture);
                }else {
                // If not found in Student model, try to fetch the teacher's details using the user's email
                $teacher = Teacher::where('email', $user->email)->first();
                
                if ($teacher) {
                    // Set user_name and user_avatar from the Teacher model
                    $chat->user_name = $teacher->name;
                    $chat->user_avatar = asset('Teacher Picture/' . $teacher->picture);
                }
            }
        }
            
            unset($chat->user_id);

            return $chat;
        });
    
        return response()->json(["all_chats" => $all_chats]);
    }

    public function store_chat_api(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'channel_name' => ['required'],
            'message' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        Chat::create($data);
        return response()->json(['message' => 'Message sent successfully']);
    }
     public function all_chat($channel_name)
    {
        $messages = Chat::where('channel_name', $channel_name)->orderBy('created_at', 'asc')->get();
    
        $messages->transform(function ($message) {
            // Fetch the user's email from the User model
            $user = User::find($message->user_id);
    
            if ($user) {
                // Fetch the student's details using the user's email
                $student = Student::where('email', $user->email)->first();
    
                if ($student) {
                    // Set user_name and user_avatar from the Student model
                    $message->user_name = $student->name;
                    $message->user_avatar = asset('Student Picture/' . $student->picture);
                } else {
                    // If the user is not a student, check in the Teacher model
                    $teacher = Teacher::where('email', $user->email)->first();
    
                    if ($teacher) {
                        // Set user_name and user_avatar from the Teacher model
                        $message->user_name = $teacher->name;
                        $message->user_avatar = asset('Teacher Picture/' . $teacher->picture);
                    }
                }
            }
    
            unset($message->user_id);
    
            return $message;
        });
    
        return response()->json([
            'status' => true,
            'messages' => $messages
        ]);
    }


    public function store_chat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'channel_name' => ['required'],
            'message' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userEmail = Auth::user()->email;
        $user_details = Student::where('email', $userEmail)->first();
        
        $data = $request->all();
        Chat::create($data);
        return response()->json(['message' => 'Message sent successfully']);
    }
}
