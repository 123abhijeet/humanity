<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Backend\Student;
use App\Models\Teacher\Joineduser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class JoinedUserController extends Controller
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
    public function all_users($channel_name)
{
    $all_users = Joineduser::where('channel_name', $channel_name)->select('user_id')->get();

    $all_users = $all_users->map(function ($joined_user) {
        $user = User::find($joined_user->user_id);

        if ($user) {
            $student = Student::where('email', $user->email)->first();

            if ($student) {
                return [
                    'user_name' => $student->name,
                    'user_avatar' => asset('Student Picture/' . $student->picture)
                ];
            }
        }

        return null;
    })->filter(); // Filter out null values

    return response()->json(["all_users" => $all_users->values()]);
}

    public function store_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'channel_name' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        Joineduser::create($data);
        return response()->json(['message' => 'User stored successfully']);
    }
    public function delete_user(Request $request)
    {
        Joineduser::where('channel_name', $request->channel_name)->where('user_id', Auth::user()->id)->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
