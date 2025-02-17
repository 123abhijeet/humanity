<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\image_resize_helper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Book;
use App\Models\Backend\Category;
use App\Models\Backend\Course;
use App\Models\Backend\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('backend.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $courses = Course::all();
        return view('backend.book.create', compact('category', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255', Rule::unique('books', 'title')],
            'price' => ['required'],
            'publication' => ['required'],
            'language' => ['required'],
            'subject' => ['required'],
            'description' => ['required'],
            'cover_image' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
       
        if ($request->hasFile('cover_image')) {

            $cover_image = time() . 'cover_image' . '.' . $request->cover_image->extension();

            $request->cover_image->move(public_path('Book Cover'), $cover_image);

            image_resize_helper::resizeImage(public_path('Book Cover/' . $cover_image), 600, 400);

            $data['cover_image'] = $cover_image;
        }

        Book::create($data);
        return redirect()->route('books.index')->with('success', 'Data Stored Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $category = Category::where('id',$book->course_category)->first();
        $subcategory = Subcategory::where('id', $book->course_subcategory)->first();
        $course = Course::where('id',$book->course)->first();
        return view('backend.book.view', ['book' => $book,'course' => $course, 'category' => $category, 'subcategory' => $subcategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $category = Category::where('id',$book->course_category)->first();
        $subcategory = Subcategory::where('id', $book->course_subcategory)->first();
        $course = Course::where('id',$book->course)->first();
        return view('backend.book.edit', ['book' => $book,'course' => $course, 'category' => $category, 'subcategory' => $subcategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required'],
            'publication' => ['required'],
            'language' => ['required'],
            'subject' => ['required'],
            'description' => ['required']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        $current_cover_image = Book::findOrFail($book->id)->cover_image;

        if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {
            $cover_image = time() . 'cover_image' . '.' . $request->cover_image->extension();
            $request->cover_image->move(public_path('Book Cover'), $cover_image);
            image_resize_helper::resizeImage(public_path('Book Cover/' . $cover_image), 600, 400);
            $data['cover_image'] = $cover_image;

            if ($current_cover_image) {
                if (file_exists(public_path('Book Cover/' . $current_cover_image))) {
                    unlink(public_path('Book Cover/' . $current_cover_image));
                }
            }

            $data['cover_image'] = $cover_image;
        } else {
            $cover_image = $current_cover_image;
            $data['cover_image'] = $cover_image;
        }

        $book->update($data);
        return redirect()->route('books.index')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $current_cover_image = Book::findOrFail($book->id)->cover_image;
        if ($current_cover_image) {
            unlink(public_path('Book Cover') . '/' . $current_cover_image);
        }
        $book->delete();
        return redirect()->route('books.index')->with('error', 'Data Removed Successfully');
    }
}
