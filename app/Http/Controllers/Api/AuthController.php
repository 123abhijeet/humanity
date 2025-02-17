<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\SendingOTP;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => "Invalid Inputs",
                "error" => $validator->getMessageBag()->toArray()
            ], 401);
        } else {
            $user_info = User::where('email', $request->email)->first();

            if ($user_info) {
                if ($user_info->status == 0) {
                    return response()->json([
                        "status" => false,
                        "message" => "Sorry, Your account is restricted! Contact administrator.",
                    ], 201);
                } else {
                    $otp = mt_rand(1000, 9999);
                    try {
                        Mail::to($request->email)->send(new SendingOTP($request->email, $otp));
                    } catch (Exception $exception) {
                        \Log::error('Mail sending error: ' . $exception->getMessage());
                    }


                    if ($user_info) {
                        User::where('email', $request->email)->update([
                            "otp" => $otp
                        ]);
                        return response()->json([
                            "status" => true,
                            "message" => "OTP sent on mail.",
                            'user_details' => $user_info
                        ], 201);
                    } else {
                        $user = User::create([
                            "email" => $request->email,
                            "otp" => $otp
                        ]);

                        return response()->json([
                            "status" => true,
                            "message" => "User successfully registered.",
                            'user_details' => $user,
                        ], 201);
                    }
                }
            } else {
                $otp = mt_rand(1000, 9999);
                try {
                    Mail::to($request->email)->send(new SendingOTP($request->email, $otp));
                } catch (Exception $exception) {
                    \Log::error('Mail sending error: ' . $exception->getMessage());
                }
                $user = User::create([
                    "email" => $request->email,
                    "otp" => $otp
                ]);

                return response()->json([
                    "status" => true,
                    "message" => "User successfully registered.",
                    'user_details' => $user,
                ], 201);
            }
            
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "otp" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => "Invalid Inputs",
                "error" => $validator->getMessageBag()->toArray()
            ], 401);
        } else {
            // Verify OTP
            $user = User::where('email', $request->email)
                ->where('otp', $request->otp)
                ->first();

            if (!$user) {
                return response()->json([
                    "status" => false,
                    "message" => "Invalid OTP",
                ], 401);
            }

            // Clear OTP after successful login (Optional)
            $user->otp = null;
            $user->save();

            $token = $user->createToken('my-app-token')->plainTextToken;
            $student_exists = Student::where('email', $request->email)->first();

            if ($student_exists) {
                return response()->json([
                    "status" => true,
                    "message" => "Student Exists",

                    'user_details' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'otp' => $user->otp,
                        'status' => $user->status
                    ],
                    'token' => $token,
                ], 200);
            } else {
                return response()->json([
                    "status" => true,
                    "message" => "Student doesn't Exists",
                    'user_details' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'otp' => $user->otp,
                    ],
                    'token' => $token,
                ], 200);
            }
        }
    }
}
