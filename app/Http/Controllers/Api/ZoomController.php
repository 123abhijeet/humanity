<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Student;
use App\Models\Backend\Teacher;
use App\Models\Teacher\Liveclass;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ZoomController extends Controller
{
    public function createMeeting(Request $request): array
    {
        // Validate input
        $validated = $this->validate($request, [
            'title' => 'required',
            'start_date_time' => 'required',
            'duration_in_minute' => 'required|numeric'
        ]);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . self::generateToken(),
                'Content-Type' => 'application/json',
            ])->post("https://api.zoom.us/v2/users/me/meetings", [
                'topic' => $validated['title'],
                'type' => 2, // 2 for scheduled meeting
                'start_time' => Carbon::parse($validated['start_date_time'])->toIso8601String(),
                'duration' => $validated['duration_in_minute'],
            ]);
            $responseData = $response->json();
            $teachers_details = Teacher::where('user_id', 11)->first();
            Liveclass::create([
                'course_category' => $teachers_details->course_category,
                'course_subcategory' => $teachers_details->course_subcategory,
                'course_id' => 1,
                'teacher_id' => 11,
                'meeting_id' => $responseData['id'],
                'topic' => $responseData['topic'],
                'join_url' => $responseData['join_url'],
                'start_time' => $validated['start_date_time'],
                'duration' => $responseData['duration'],
                'password' => $responseData['password'],
            ]);
            return $response->json();
            // return ['join_url' => $response->json()['join_url']];
            // return [
            //     'join_url' => $response['join_url'],
            //     'start_time' => $response['start_time'],
            //     'duration' => $response['duration'],
            //     'topic' => $response['topic'],
            //     'password' => $response['password'],
            //     'meeting_id' => $response['id'],
            // ];
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
    public function generateSignature(Request $request)
    {
        $apiKey = env('SDK_KEY');
        $apiSecret = env('SDK_SECRET');
        $meetingNumber = $request->meetingNumber;
        $role = $request->role;

        $timestamp = round(microtime(true) * 1000) - 30000;

        $msg = base64_encode($apiKey . $meetingNumber . $timestamp . $role);
        $hash = hash_hmac('sha256', $msg, $apiSecret, true);
        $signature = base64_encode($apiKey . '.' . $meetingNumber . '.' . $timestamp . '.' . $role . '.' . base64_encode($hash));

        return response()->json(['signature' => rtrim(strtr($signature, '+/', '-_'), '=')]);
    }
    public function get_all_live_classes()
    {
        $userEmail = Auth::user()->email;
        $user_details = Student::where('email', $userEmail)->first();

        $classes = Liveclass::join('teachers', 'teacher_id', 'teachers.user_id')
            ->where('liveclasses.course_category', $user_details->category)->where('liveclasses.course_subcategory', $user_details->subcategory)
            ->select('liveclasses.title', 'liveclasses.meeting_id', 'liveclasses.start_time', 'liveclasses.duration', 'liveclasses.join_url', 'liveclasses.password', 'teachers.name as Teacher Name')
            ->get()
            ->map(function ($class) {
                // Convert duration from minutes to hours
                $hours = floor($class->duration / 60);
                $minutes = $class->duration % 60;
                $formattedDuration = $hours > 0 ? $hours . ' Hours' : $minutes . ' Minutes';
                $class->duration = $formattedDuration;

                return $class;
            });

        return response()->json(['classes' => $classes]);
    }
    public function get_live_class($meeting_id)
    {
        $class = Liveclass::where('meeting_id', $meeting_id)
            ->select('title', 'meeting_id', 'start_time', 'duration', 'join_url', 'password')
            ->first();

        if ($class) {
            // Convert duration from minutes to hours
            $hours = floor($class->duration / 60);
            $minutes = $class->duration % 60;
            $formattedDuration = $hours > 0 ? $hours . ' Hours' : $minutes . ' Minutes';
            $class->duration = $formattedDuration;
        }
        return response()->json($class);
    }
}
