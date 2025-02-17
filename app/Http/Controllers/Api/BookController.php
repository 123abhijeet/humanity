<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Book;
use App\Models\Backend\Bookpayment;
use App\Models\Backend\Category;
use App\Models\Backend\Student;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
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
    public function get_books(Request $request)
    {
        try {
            $books = Book::select('id', 'title', 'price', 'publication', 'description', 'cover_image')->get();
            $books->transform(function ($book) {
                $book->cover_image = asset('Book Cover/' . $book->cover_image);
                return $book;
            });
            return response()->json(['books' => $books]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function get_books_subjects()
    {
        $subjects = Book::whereNotNull('subject')->distinct()->pluck('subject')->toArray();
        array_unshift($subjects, "All Subjects");
        return response()->json(['subjects' => $subjects]);
    }
    public function get_books_by_subjects(Request $request)
    {
        $userEmail = Auth::user()->email;
        $user_details = Student::where('email', $userEmail)->first();

        if ($request->subject) {
            if ($request->subject == 'All Subjects') {
                $subjects = Book::where('course_category', $user_details->category)->where('course_subcategory', $user_details->subcategory)
                    ->select('id', 'title', 'price', 'subject', 'description', 'publication', 'cover_image')
                    ->get();
                // Iterate through each subject and prepend the base URL to the course_banner field
                $subjects->transform(function ($subject) {
                    $subject->cover_image = asset('Book Cover/' . $subject->cover_image);
                    return $subject;
                });
            } else {
                $subjects = Book::where('course_category', $user_details->category)->where('course_subcategory', $user_details->subcategory)
                    ->where('subject', $request->subject)
                    ->select('id', 'title', 'price', 'subject', 'description', 'publication', 'cover_image')
                    ->get();
                // Iterate through each subject and prepend the base URL to the course_banner field
                $subjects->transform(function ($subject) {
                    $subject->cover_image = asset('Book Cover/' . $subject->cover_image);
                    return $subject;
                });
            }
        } else {
            $subjects = Book::where('course_category', $user_details->category)->where('course_subcategory', $user_details->subcategory)
                ->select('id', 'title', 'price', 'subject', 'description', 'publication', 'cover_image')
                ->get();
            // Iterate through each subject and prepend the base URL to the course_banner field
            $subjects->transform(function ($subject) {
                $subject->cover_image = asset('Book Cover/' . $subject->cover_image);
                return $subject;
            });
        }
        return response()->json(['subjects' => $subjects]);
    }
    public function get_book_by_id($book_id)
    {
        try {
            $book = Book::where('id', $book_id)
                ->select('id', 'title', 'price', 'subject', 'description', 'publication', 'cover_image')
                ->first();

            $book = collect([$book])->transform(function ($item) {
                $item->cover_image = asset('Book Cover/' . $item->cover_image);
                return $item;
            })->first();
            return response()->json(['book' => $book]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function getOrderid()
    {
        $order_detail = Bookpayment::orderBy('order_no', 'desc')->first();
        if (empty($order_detail)) {
            $next_order_no = 'OD' . sprintf('%03d', 001);
        } else {
            $numeric_part = intval(substr($order_detail->order_no, 2)); // "OD" is the prefix
            $next_numeric_part = $numeric_part + 1;

            // Format the numeric part with leading zeros
            $next_order_no = 'OD' . sprintf('%03d', $next_numeric_part);
        }

        return $next_order_no;
    }
    public function store_book_payment(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "book_id" => "required",
                "transaction_id" => "required",
                "amount" => "required",
                "payment_status" => "required",
                "name" => "required",
                "email" => "required",
                "mobile" => "required",
                "address" => "required"
            ]);
            if ($validator->fails()) {
                return response()->json([
                    "status" => false,
                    "message" => "Invalid Inputs",
                    "error" => $validator->getMessageBag()->toArray()
                ], 401);
            }
            $order_no = $this->getOrderid();
            Bookpayment::create([
                'book_id' => $request->book_id,
                'student_id' => Auth::user()->id,
                'order_no' => $order_no,
                'transaction_id' => $request->transaction_id,
                'amount' => $request->amount,
                'payment_status' => $request->payment_status,
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address
            ]);
            return response()->json(['message' => 'Data Submitted succefully']);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "An error occurred.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function search_book(Request $request)
    {
        $userEmail = Auth::user()->email;
        $user_details = Student::where('email', $userEmail)->first();

        $query = $request->input('query');

        $books = Book::where('title', 'like', '%' . $query . '%')
            ->orWhere('price', 'like', '%' . $query . '%')
            ->orWhere('publication', 'like', '%' . $query . '%')
            ->where('course_category', $user_details->category)->where('course_subcategory', $user_details->subcategory)
            ->select('id', 'title', 'price', 'publication', 'description', 'cover_image')
            ->get();


        // Iterate through each subject and prepend the base URL to the course_banner field
        $books->transform(function ($book) {
            $book->cover_image = asset('Book Cover/' . $book->cover_image);
            return $book;
        });

        return response()->json(['books' => $books]);
    }
    public function get_book_detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "book_id" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => "Invalid Inputs",
                "error" => $validator->getMessageBag()->toArray()
            ], 401);
        } else {
            $book_details = Book::where('id', $request->book_id)
                ->select('id', 'title', 'price', 'subject', 'description', 'publication', 'cover_image')
                ->first();

            $book_details = collect([$book_details])->transform(function ($item) {
                $item->cover_image = asset('Book Cover/' . $item->cover_image);
                return $item;
            })->first();

            $book_details['sub_total'] =  $book_details->price;
            $book_details['amount_payable'] = $book_details->price;
            return response()->json(['book_details' => $book_details]);
        }
    }
}
