<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Student;
use App\Models\Backend\Subcategory;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function get_profile(Request $request)
    {
        try {
            // Extract the authenticated user's email from the token
            $userEmail = Auth::user()->email;

            // Fetch the profile details based on the user's email
            $profile_details = Student::join('categories', 'students.category', '=', 'categories.id')
                ->join('subcategories', 'students.subcategory', '=', 'subcategories.id')
                ->where('students.email', $userEmail)
                ->select('students.id', 'students.name', 'students.email', 'students.mobile', 'students.picture', 'categories.id as category_id','categories.category_name', 'subcategories.id as subcategory_id','subcategories.subcategory_name')
                ->first();

            // If profile_details is not null
            if ($profile_details->picture) {
                // Prepend the base URL to the student's picture
                $profile_details->picture = asset('Student Picture/' . $profile_details->picture);
            }else{
                $profile_details->picture == null;
            }
            if (!$profile_details) {
                return response()->json([
                    "status" => false,
                    "message" => "No Data Found",
                ], 500);
            } else {
                return response()->json(['profile_details' => $profile_details]);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function update_profile(Request $request)
    {
        try {
            $userEmail = Auth::user()->email;
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Invalid Inputs",
                    "error" => $validator->getMessageBag()->toArray()
                ], 401);
            } else {
                User::where('email', $userEmail)->update([
                    'name' => $request->name,
                ]);

                $current_picture = Student::where('email', $userEmail)->first();

                if ($current_picture) {
                    $current_picture = $current_picture->picture;

                    if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                        $picture = time() . 'picture' . '.' . $request->picture->extension();
                        $request->picture->move(public_path('Student Picture'), $picture);
                        $data['picture'] = $picture;

                        // Delete the old picture file if it exists
                        if ($current_picture && file_exists(public_path('Student Picture') . '/' . $current_picture)) {
                            unlink(public_path('Student Picture') . '/' . $current_picture);
                        }
                    } else {
                        $picture = $current_picture;
                        $data['picture'] = $picture;
                    }
                } else {
                    $picture = null; // Set picture to null if no current picture found
                    $data['picture'] = $picture;
                }

                $category = Category::where('category_name', $request->category)->first();
                $subcategory = Subcategory::where('subcategory_name', $request->subcategory)->first();

                Student::where('email', $userEmail)->update([
                    'name' => $request->name,
                    'mobile' => $request->mobile,
                    'category' => $category->id,
                    'subcategory' => $subcategory->id,
                    'picture' => $picture
                ]);

                return response()->json([
                    "status" => true,
                    "message" => "Profile Updated Successfully",
                ], 201);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred while updating the profile.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
