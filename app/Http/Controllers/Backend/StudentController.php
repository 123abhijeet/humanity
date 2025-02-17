<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Course;
use App\Models\Backend\Coursecertificate;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::join('students', 'users.email', 'students.email')
            ->select('users.id as user_id', 'users.name', 'users.email', 'users.status', 'students.mobile')
            ->get();
        return view('backend.student.index', compact('students'));
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
    public function update_student_status(Request $request)
    {
        User::where('id', $request->userId)->update([
            'status' => $request->status
        ]);
        return response()->json(['message' => 'Status Updated Successfully']);
    }
    public function certificate()
    {
        return view('certificate');
    }
    public function generate_certificate($student_id, $course_id)
    {
        $course_certificate_details = Coursecertificate::where('student_id', $student_id)->where('course_id', $course_id)->first();
        $course = Course::where('id', $course_id)->first();
        $student_details = User::where('id', $student_id)->first();
        // Generate PDF
        $pdf = Pdf::loadView('certificate', [
            'student_name' => $student_details->name,
            'course_name' => $course->course_name,
            'course_start_date' => $course_certificate_details->created_at->format('F d, Y'),
            'course_end_date' => Carbon::now()->format('F d, Y'),
            'certificate_issued_date' => Carbon::now()->format('F d, Y'),
            'certificate_no' => $course_certificate_details->certificate_no
        ]);

        $pdf_content = $pdf->output();

        $relativePdfPath = 'Course Certificate/' . $course_certificate_details->certificate_no . '.pdf';

        // Ensure the directory exists
        if (!file_exists(public_path('Course Certificate'))) {
            mkdir(public_path('Course Certificate'), 0755, true);
        }

        // Save the generated PDF content to the public folder
        file_put_contents($relativePdfPath, $pdf_content);

        Coursecertificate::where('student_id', $student_id)->where('course_id', $course_id)->update([
            'certificate' => $relativePdfPath
        ]);
        return redirect()->route('coursecertificates.index')->with('success', 'Certificate Generated Successfully');
    }
}
