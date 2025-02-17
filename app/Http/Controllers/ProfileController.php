<?php

namespace App\Http\Controllers;

use App\Helpers\image_resize_helper;
use App\Models\Backend\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
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
    public function my_profile()
    {
        return view('backend.profile.myprofile');
    }
    public function edit_profile()
    {
        return view('backend.profile.editprofile');
    }
    public function update_profile(Request $request)
    {
        if ($request->password == null) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            User::where('email', $request->email)->update([
                'name' => $request->name,
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            User::where('email', $request->email)->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);
        }
        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }
    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $teacher = Teacher::where('user_id', Auth::user()->id)->firstOrFail();
        $current_picture = $teacher->picture;

        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            $picture = time() . '_picture.' . $request->picture->extension();

            $request->picture->move(public_path('Teacher Picture'), $picture);

            image_resize_helper::resizeImage(public_path('Teacher Picture/' . $picture), 500, 500);

            if ($current_picture && file_exists(public_path('Teacher Picture/' . $current_picture))) {
                unlink(public_path('Teacher Picture/' . $current_picture));
            }
        } else {
            $picture = $current_picture;
        }

        $teacher->update(['picture' => $picture]);

        return back()->with('success', 'Profile image updated successfully!');
    }
}
