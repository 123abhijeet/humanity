<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Course;
use App\Models\Backend\Offer;
use App\Models\Backend\Subcategory;
use App\Models\Teacher\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = Offer::latest()->get();
        return view('backend.offer.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $courses = Course::all();
        $quizzes = Quiz::whereNotNull('price')->get();
        return view('backend.offer.create', compact('category', 'courses', 'quizzes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'course_category' => ['required'],
            'course_subcategory' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'offer_value' => ['required'],
            'offer_title' => ['required', Rule::unique('offers', 'offer_title')],
            'offer_code' => ['required', Rule::unique('offers', 'offer_code')],
            'offer_banner' => ['required', 'mimes:jpg', 'max:2048'],
        ];

        if ($request->offer_type == "course") {
            $rules['course_id'] = 'required';
        } else {
            $rules['quiz_id'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('offer_banner')) {

            $directory = public_path('Offer Banner');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true); // Create directory recursively with permissions
            }
            $offer_banner = $request->file('offer_banner');
            $imageName = time() . '.' . $offer_banner->getClientOriginalExtension();
            $imagePath = public_path('Offer Banner') . '/' . $imageName;
            $imageResource = imagecreatefromjpeg($offer_banner->getPathname()); // Adjust based on image type

            $text = $request->offer_code;
            $fontPath = public_path('fonts') . '/arial.ttf'; // Path to a font file
            $fontSize = 200;
            $fontColor = imagecolorallocate($imageResource, 255, 255, 255); // White color

            // Calculate text size
            $textBoundingBox = imagettfbbox($fontSize, 0, $fontPath, $text);
            $textWidth = $textBoundingBox[4] - $textBoundingBox[0];
            $textHeight = $textBoundingBox[1] - $textBoundingBox[5];

            // Position text on the right side of the horizontal line
            $x = imagesx($imageResource) - $textWidth - 100; // Adjust the padding from right side
            $y = imagesy($imageResource) / 2 + $textHeight / 2 + 500; // Center vertically

            imagettftext($imageResource, $fontSize, 0, $x, $y, $fontColor, $fontPath, $text);

            imagejpeg($imageResource, $imagePath); // Save the modified image back

            imagedestroy($imageResource);
            $offer_banner_path = 'Offer Banner/' . $imageName;
        }

        Offer::create([
            'course_category' => $request->course_category,
            'course_subcategory' => $request->course_subcategory,
            'offer_type' => $request->offer_type,
            'course_id' => $request->course_id,
            'quiz_id' => $request->quiz_id,
            'offer_title' => $request->offer_title,
            'offer_code' => $request->offer_code,
            'offer_value' => $request->offer_value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'offer_banner' => $offer_banner_path
        ]);
        return redirect()->route('offers.index')->with('success', 'Data Stored Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        $category = Category::where('id', $offer->course_category)->first();
        $subcategory = Subcategory::where('id', $offer->course_subcategory)->first();
        $course = Course::where('id', $offer->course_id)->first();
        $quiz = Quiz::where('id', $offer->quiz_id)->first();
        return view('backend.offer.view', ['course' => $course, 'quiz' => $quiz, 'offer' => $offer, 'category' => $category, 'subcategory' => $subcategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        $category = Category::where('id', $offer->course_category)->first();
        $subcategory = Subcategory::where('id', $offer->course_subcategory)->first();
        $course = Course::where('id', $offer->course_id)->first();
        $quiz = Quiz::where('id', $offer->quiz_id)->first();
        return view('backend.offer.edit', ['course' => $course, 'quiz' => $quiz, 'offer' => $offer, 'category' => $category, 'subcategory' => $subcategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Offer $offer)
    {
        $rules = [
            'offer_title' => ['required'],
            'offer_value' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required']
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Offer::where('id', $offer->id)->update([
            'offer_title' => $request->offer_title,
            'offer_value' => $request->offer_value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status
        ]);
        return redirect()->route('offers.index')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        $current_offer_banner = Offer::findOrFail($offer->id)->offer_banner;
        if ($current_offer_banner) {
            unlink(public_path() . '/' . $current_offer_banner);
        }
        $offer->delete();
        return redirect()->route('offers.index')->with('error', 'Data Removed Successfully');
    }
}
