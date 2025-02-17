<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        $subcategory = Subcategory::orderBy('id', 'desc')->get();
        return view('backend.course.subcategory.index', compact('category','subcategory'));
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
            "subcategory_name" => ['required', 'unique:subcategories'],
            "subcategory_image" => ['max:200'],
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        } else {
            $data = [
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
            ];
        
            if ($request->hasFile('subcategory_image')) {
                $subcategory_image = time() . 'subcategory_image' . '.' . $request->subcategory_image->extension();
                $request->subcategory_image->move(public_path('Sub Category Image'), $subcategory_image);
                $data['subcategory_image'] = $subcategory_image;
            }
        
            Subcategory::create($data);
        }
        
        return response()->json(['success' => 'Sub Category Added Successfully']);
        
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
    public function update(Request $request, Subcategory $subcategory)
    {
        $validator = Validator::make($request->all(), [
            "subcategory_name" => ['required'],
            "subcategory_image" => ['max:200'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        } else {
            $current_subcategory_image = Subcategory::findOrFail($subcategory->id)->subcategory_image;

            if ($request->hasFile('subcategory_image') && $request->file('subcategory_image')->isValid()) {
                $subcategory_image = time() . 'subcategory_image' . '.' . $request->subcategory_image->extension();
                $request->subcategory_image->move(public_path('Sub Category Image'), $subcategory_image);

                if ($current_subcategory_image) {
                    unlink(public_path('Sub Category Image') . '/' . $current_subcategory_image);
                }
            } else {
                $subcategory_image = $current_subcategory_image;
            }
            Subcategory::where('id', $subcategory->id)->update([
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
                'subcategory_image' => $subcategory_image
            ]);
        }
        return response()->json(['success' => 'Sub Category Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        $current_subcategory_image = Subcategory::findOrFail($subcategory->id)->subcategory_image;
        if ($current_subcategory_image) {
            unlink(public_path('Sub Category Image') . '/' . $current_subcategory_image);
        }
        $subcategory->delete();
        return redirect()->route('subcategory.index')->with('error', 'Sub Category Removed Successfully');
    }
}
