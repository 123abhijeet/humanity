<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy('id', 'desc')->get();
        return view('backend.course.category.index', compact('category'));
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
            "category_name" => ['required', 'unique:categories'],
            "category_image" => ['max:200'],
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        } else {
            $data = [
                'category_name' => $request->category_name,
            ];
        
            if ($request->hasFile('category_image')) { // Check if the image file exists in the request
                $category_image = time() . 'category_image' . '.' . $request->category_image->extension();
                $request->category_image->move(public_path('Category Image'), $category_image);
                $data['category_image'] = $category_image;
            }
            
            Category::create($data);
        }
        
        return response()->json(['success' => 'Category Added Successfully']);
        
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
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            "category_name" => ['required'],
            "category_image" => ['max:200'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        } else {
            $current_category_image = Category::findOrFail($category->id)->category_image;

            if ($request->hasFile('category_image') && $request->file('category_image')->isValid()) {
                $category_image = time() . 'category_image' . '.' . $request->category_image->extension();
                $request->category_image->move(public_path('Category Image'), $category_image);

                if ($current_category_image) {
                    unlink(public_path('Category Image') . '/' . $current_category_image);
                }
            } else {
                $category_image = $current_category_image;
            }
            Category::where('id', $category->id)->update([
                'category_name' => $request->category_name,
                'category_image' => $category_image
            ]);
        }
        return response()->json(['success' => 'Category Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $current_category_image = Category::findOrFail($category->id)->category_image;
        if ($current_category_image) {
            unlink(public_path('Category Image') . '/' . $current_category_image);
        }
        $category->delete();
        return redirect()->route('category.index')->with('error', 'Category Removed Successfully');
    }
}
