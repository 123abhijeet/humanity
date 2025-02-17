<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Course;
use App\Models\Backend\Subcategory;
use App\Models\Teacher\Liveclass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class LiveClassController extends Controller
{
    public function index()
    {
        $liveclasses = Liveclass::all();
        return view('backend.liveclasses.index', compact('liveclasses'));
    }

    public function create()
    {
        $category = Category::all();
        $courses = Course::all();
        return view('backend.liveclasses.create', compact('category', 'courses'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_category' => ['required'],
            'course_subcategory' => ['required'],
            'course_id' => ['required'],
            'title' => ['required'],
            'duration' => ['required'],
            'start_time' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->createZoomMeeting($request->all());

        return redirect()->route('liveclasses.index')->with('success', 'Meeting created successfully.');
    }

    protected function createZoomMeeting($data)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . self::generateToken(),
                'Content-Type' => 'application/json',
            ])->post("https://api.zoom.us/v2/users/me/meetings", [
                'topic' => $data['title'],
                'type' => 2, // 2 for scheduled meeting
                'start_time' => Carbon::parse($data['start_time'])->toIso8601String(),
                'duration' => $data['duration'],
            ]);
            $responseData = $response->json();

            Liveclass::create([
                'course_category' => $data['course_category'],
                'course_subcategory' => $data['course_subcategory'],
                'course_id' => $data['course_id'],
                'teacher_id' => Auth::user()->id,
                'meeting_id' => $responseData['id'],
                'title' => $data['title'],
                'join_url' => $responseData['join_url'],
                'start_time' => $data['start_time'],
                'duration' => $data['duration'],
                'password' => $responseData['password'],
            ]);

            if ($response->successful()) {
                return true;
            } else {
                throw new \Exception('Error creating Zoom meeting.');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show(Liveclass $liveclass)
    {
        $category = Category::where('id', $liveclass->course_category)->first();
        $subcategory = Subcategory::where('id', $liveclass->course_subcategory)->first();
        $course = Course::where('id', $liveclass->course_id)->first();
        return view('backend.liveclasses.view', ['liveclass' => $liveclass, 'category' => $category, 'subcategory' => $subcategory, 'course' => $course]);
    }

    public function edit(Liveclass $liveclass)
    {
        $category = Category::all();
        $subcategory = Subcategory::where('id', $liveclass->course_subcategory)->first();
        return view('backend.liveclasses.edit', ['liveclass' => $liveclass, 'category' => $category, 'subcategory' => $subcategory]);
    }

    public function update(Request $request, Liveclass $liveclass)
    {
        $request->validate([
            'course_category' => ['required'],
            'course_subcategory' => ['required'],
            'course_id' => ['required'],
            'title' => ['required'],
            'duration' => ['required'],
            'start_time' => ['required'],
        ]);

        $this->updateZoomMeeting($liveclass->meeting_id, $request->all());

        // Then update the meeting in the local database
        $liveclass->update($request->all());

        return redirect()->route('liveclasses.index')->with('success', 'Meeting updated successfully.');
    }

    protected function updateZoomMeeting($meetingId, $data)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->generateToken(),
                'Content-Type' => 'application/json',
            ])->patch("https://api.zoom.us/v2/meetings/{$meetingId}", [
                'topic' => $data['title'],
                'type' => 2, // 2 for scheduled meeting
                'start_time' => Carbon::parse($data['start_time'])->toIso8601String(),
                'duration' => $data['duration'],
            ]);

            if ($response->successful()) {
                return true;
            } else {
                throw new \Exception('Error updating Zoom meeting.');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Liveclass $liveclass)
    {
        // First delete the meeting from Zoom
        $this->deleteZoomMeeting($liveclass->meeting_id);

        // Then delete the meeting from the local database
        $liveclass->delete();

        return redirect()->route('liveclasses.index')->with('success', 'Meeting deleted successfully.');
    }

    protected function deleteZoomMeeting($meetingId)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->generateToken(),
            ])->delete("https://api.zoom.us/v2/meetings/{$meetingId}");

            if ($response->successful()) {
                return true;
            } else {
                throw new \Exception('Error deleting Zoom meeting: ' . $response->body());
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    protected function generateToken(): string
    {
        try {
            $base64String = base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET'));
            $accountId = env('ZOOM_ACCOUNT_ID');

            $responseToken = Http::withHeaders([
                "Content-Type" => "application/x-www-form-urlencoded",
                "Authorization" => "Basic {$base64String}"
            ])->post("https://zoom.us/oauth/token?grant_type=account_credentials&account_id={$accountId}");

            return $responseToken->json()['access_token'];
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function join_meeting($id)
    {
        $meeting_detail = Liveclass::where('id', $id)->first();
        $meetingId = $meeting_detail->meeting_id;
        $password = $meeting_detail->password;

        // Include additional parameters such as user details and ZAK token
        $sdkKey = env('SDK_KEY');
        $userName = 'Teacher';
        $userEmail = 'teacher@gmail.com';
        $zakToken = 'eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMSIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0';
        $leaveUrl = 'https://sattreevision.in/Panel/liveclasses';
        $role = 1;

        return view('backend.join_meeting', [
            'meetingId' => $meetingId,
            'password' => $password,
            'sdkKey' => $sdkKey,
            'userName' => $userName,
            'userEmail' => $userEmail,
            'zakToken' => $zakToken,
            'leaveUrl' => $leaveUrl,
            'role' => $role
        ]);
    }
}
