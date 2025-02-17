<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher\Studymaterialtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudyMaterialTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Studymaterialtype::orderBy('id', 'desc')->get();
        return view('backend.studymaterial.type.index', compact('types'));
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
            "type" => ['required', 'unique:studymaterialtypes'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        } else {
            $data = $request->all();
            Studymaterialtype::create($data);
        }

        return response()->json(['success' => 'Type Added Successfully']);
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
    public function update(Request $request, Studymaterialtype $studymaterialtype)
    {
        $validator = Validator::make($request->all(), [
            "type" => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        }
        $data = $request->all();
        $studymaterialtype->update($data);
        return response()->json(['success' => 'Type Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Studymaterialtype $studymaterialtype)
    {
        $studymaterialtype->delete();
        return redirect()->route('studymaterialtypes.index')->with('error', 'Type Removed Successfully');
    }
}
