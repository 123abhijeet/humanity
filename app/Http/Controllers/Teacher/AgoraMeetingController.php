<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Teacher\Agorameeting;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Subcategory;
use App\Models\Backend\Category;
use App\Agora\RtmTokenBuilder2;
use App\Models\Backend\Student;
use App\Agora\RtcTokenBuilder;
use App\Models\Backend\Course;
use Illuminate\Http\Request;
use App\Models\Teacher\Chat;
use App\Models\Teacher\Joineduser;
use Carbon\Carbon;
use Exception;

class AgoraMeetingController extends Controller
{
    public function index()
    {
        $meetings = Agorameeting::where('teacher_id', Auth::user()->id)->get();
        return view('backend.liveclasses.index', compact('meetings'));
        // return response()->json($meetings);
    }
    public function create()
    {
        $category = Category::all();
        $courses = Course::all();
        return view('backend.liveclasses.create', compact('category', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_category' => ['required'],
            'course_subcategory' => ['required'],
            'course_id' => ['required'],
            'title' => 'required|string|max:255',
            'start_time' => ['required'],
            'end_time' => ['required'],
        ]);

        $start_time = Carbon::parse($request->input('start_time'));
        $end_time = Carbon::parse($request->input('end_time'));

        $duration = $end_time->diff($start_time);
        $hours = $duration->h + ($duration->days * 24); // Add days to hours
        $minutes = $duration->i;
        $formattedDuration = sprintf('%d Hour%s : %d Min', $hours, $hours != 1 ? 's' : '', $minutes);

        Agorameeting::create([
            'course_category' => $validated['course_category'],
            'course_subcategory' => $validated['course_subcategory'],
            'course_id' => $validated['course_id'],
            'teacher_id' => Auth::user()->id,
            'title' => $validated['title'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'duration' => $formattedDuration,
            'agora_channel' => $this->generateAgoraChannelName(),
        ]);

        // return response()->json($meeting, 201);
        return redirect()->route('Agora-Meetings')->with('success', 'Meeting created successfully.');
    }

    public function edit($id)
    {
        $meeting = Agorameeting::find($id);

        if (!$meeting) {
            return response()->json(['error' => 'Meeting not found'], 404);
        }

        $category = Category::all();
        $subcategory = Subcategory::where('id', $meeting->course_subcategory)->first();
        return view('backend.liveclasses.edit', ['meeting' => $meeting, 'category' => $category, 'subcategory' => $subcategory]);

        // return response()->json($meeting);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'course_category' => ['required'],
            'course_subcategory' => ['required'],
            'course_id' => ['required'],
            'title' => 'required|string|max:255',
            'start_time' => ['required'],
            'end_time' => ['required'],
        ]);

        $meeting = Agorameeting::find($id);

        if (!$meeting) {
            return response()->json(['error' => 'Meeting not found'], 404);
        }

        $meeting->update($validated);
        return redirect()->route('Agora-Meetings')->with('success', 'Meeting updated successfully.');
        // return response()->json($meeting);
    }

    public function show($id)
    {
        $meeting = Agorameeting::find($id);

        if (!$meeting) {
            return response()->json(['error' => 'Meeting not found'], 404);
        }

        $category = Category::where('id', $meeting->course_category)->first();
        $subcategory = Subcategory::where('id', $meeting->course_subcategory)->first();
        $course = Course::where('id', $meeting->course_id)->first();
        return view('backend.liveclasses.view', ['meeting' => $meeting, 'category' => $category, 'subcategory' => $subcategory, 'course' => $course]);

        // return response()->json($meeting);
    }

    public function destroy($id)
    {
        $meeting = Agorameeting::find($id);

        if (!$meeting) {
            return response()->json(['error' => 'Meeting not found'], 404);
        }

        $meeting->delete();
        return redirect()->route('Agora-Meetings')->with('success', 'Meeting deleted successfully.');
        // return response()->json(['message' => 'Meeting deleted successfully']);
    }

    private function generateAgoraChannelName()
    {
        return uniqid('channel_');
    }

    public function getToken($channelName)
    {
        $appId = env('AGORA_APP_ID');
        $appCertificate = env('AGORA_APP_CERTIFICATE');
        $uid = 0; // or generate a unique UID for each user
        $role = RtcTokenBuilder::RolePublisher;
        $expireTimeInSeconds = 3600; // 1 hour expiration
        $currentTimestamp = (new \DateTime())->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        $token = RtcTokenBuilder::buildTokenWithUid(
            $appId,
            $appCertificate,
            $channelName,
            $uid,
            $role,
            $privilegeExpiredTs
        );

        return response()->json(['token' => $token]);
    }
    public function getRtmToken($userAccount)
    {
        $appId = env('AGORA_APP_ID');
        $appCertificate = env('AGORA_APP_CERTIFICATE');
        $expireTimeInSeconds = 3600; // 1 hour expiration
        $currentTimestamp = (new \DateTime())->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        $token = RtmTokenBuilder2::buildToken(
            $appId,
            $appCertificate,
            $userAccount,
            $privilegeExpiredTs
        );

        return response()->json(['token' => $token, 'userAccount' => $userAccount]);
    }

    public function join_meeting($channelName)
    {
        $token = $this->getToken($channelName)->getData(true)['token'];
        $uid = Auth::user()->id; // Replace with the actual unique user ID
        $rtmToken = $this->getRtmToken($uid)->getData(true)['token'];
        return view('meeting', [
            'channelName' => $channelName,
            'token' => $token,
            'rtmToken' => $rtmToken,
            'uid' => $uid,
            "user_id"  => Auth::user()->id
        ]);
    }
    public function get_all_live_classes()
    {
        $userEmail = Auth::user()->email;
        $user_details = Student::where('email', $userEmail)->first();

        $classes = Agorameeting::join('teachers', 'teacher_id', 'teachers.user_id')
            ->join('courses', 'courses.id', 'agorameetings.course_id')
            ->where('agorameetings.course_category', $user_details->category)
            ->where('agorameetings.course_subcategory', $user_details->subcategory)
            ->where('agorameetings.end_time', '>', Carbon::now())
            ->select(
                'courses.subject as course_subject',
                'agorameetings.title',
                'agorameetings.start_time',
                'agorameetings.end_time',
                'agorameetings.duration',
                'agorameetings.joining_status',
                'agorameetings.agora_channel as channel_name',
                'teachers.name as teacher_name'
            )
            ->get()
            ->map(function ($class) {
                $class->start_time = Carbon::parse($class->start_time)->format('h:i A');
                $class->end_time = Carbon::parse($class->end_time)->format('h:i A');
                return $class;
            });

        if (!$classes) {
            return response()->json(["status" => false, "message" => "No Classes"]);
        } else {
            return response()->json(['classes' => $classes]);
        }
    }

    public function get_live_class($channel_name)
    {
        $class = Agorameeting::where('agora_channel', $channel_name)
            ->select('title', 'agora_channel', 'start_time', 'end_time', 'duration')
            ->first();

        if ($class) {
            $class->start_time = Carbon::parse($class->start_time)->format('h:i A');
            $class->end_time = Carbon::parse($class->end_time)->format('h:i A');
        }

        return response()->json($class);
    }
    public function send_message(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'channel_name' => 'required|string',
                'username' => 'required|string',
                'message' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $data = $validator->validated();
            return response()->json([
                'status' => true,
                'data' => $data,
                'message' => 'Data sent successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function update_joining_status(Request $request)
    {
        Agorameeting::where('agora_channel', $request->channelName)->update([
            'joining_status' => $request->status
        ]);
        return response()->json(['message' => 'Status Updated Successfully']);
    }
    public function reset_chats($channel_name)
    {
        Chat::where('channel_name', $channel_name)->delete();
        return response()->json(["message" => "Chat reset successfully"]);
    }
    public function reset_users($channel_name)
    {
        Joineduser::where('channel_name', $channel_name)->delete();
        return response()->json(["message" => "Users reset successfully"]);
    }
}
