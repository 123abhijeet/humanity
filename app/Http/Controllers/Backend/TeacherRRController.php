<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Teacherrr;
use Illuminate\Http\Request;

class TeacherRRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('Admin')) {
            $review_details = Teacherrr::latest()->get();
        } else {
            $review_details = Teacherrr::where('teacher_id', auth()->user()->id)->latest()->get();
        }
        return view('backend.teacherrr.index',compact('review_details'));
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
    public function update_teacherrr_status(Request $request)
    {
        Teacherrr::where('id', $request->Id)->update([
            'status' => $request->status
        ]);
        return response()->json(['message' => 'Status Updated Successfully']);
    }
}
