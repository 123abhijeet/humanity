<?php

use App\Http\Controllers\Backend\AdminNotificationController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CourseCertificateController;
use App\Http\Controllers\Backend\CourseCompletedController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\CourseRRController;
use App\Http\Controllers\Backend\OfferController;
use App\Http\Controllers\Backend\SoldcoursesController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\TeacherRRController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Teacher\AgoraMeetingController;
use App\Http\Controllers\Teacher\CoursevideoController;
use App\Http\Controllers\Teacher\LiveClassController;
use App\Http\Controllers\Teacher\PaymentController;
use App\Http\Controllers\Teacher\QueryController;
use App\Http\Controllers\Teacher\QuizController;
use App\Http\Controllers\Teacher\StudymaterialController;
use App\Http\Controllers\Teacher\StudyMaterialTypeController;
use App\Http\Controllers\Teacher\JoinedUserController;
use App\Http\Controllers\Teacher\ChatController;
use App\Http\Controllers\Teacher\TeacherNotificationController;
use App\Http\Controllers\Teacher\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('Home');
Route::get('/payment_receipt', [FrontendController::class, 'payment_receipt']);
Route::get('/generate-payment_receipt', [FrontendController::class, 'generate_payment_receipt']);
Route::get('/about', [FrontendController::class, 'about'])->name('About');
Route::get('/book-demo', [FrontendController::class, 'coming_soon'])->name('Coming-Soon');
Route::get('/courses', [FrontendController::class, 'courses'])->name('Courses');
Route::get('/our_mentors', [FrontendController::class, 'our_mentors'])->name('Our-Mentors');
Route::get('/contact', [FrontendController::class, 'contact'])->name('Contact');
Route::get('/join-as-mentor', [FrontendController::class, 'join_as_mentor'])->name('Join-AS-Mentor');
Route::post('/store-mentor', [FrontendController::class, 'store_mentor'])->name('Store-Mentor');
Route::post('/store-contact', [FrontendController::class, 'store_contact'])->name('Store-Contact');


Route::get('/privacy-policy', [FrontendController::class, 'privacy_policy'])->name('Privacy-Policy');
Route::get('/terms-&-conditions', [FrontendController::class, 'terms'])->name('Terms-Conditions');
Route::get('/return-&-refund', [FrontendController::class, 'refund'])->name('Refund-Policy');


Route::prefix('Panel')->middleware(['auth', 'checkstatus'])->group(function () {
    Route::get('/dashboard', [BackendController::class, 'index'])->name('Admin-Dashboard');

    Route::resources([
        'teachers' => TeacherController::class,
        'category' => CategoryController::class,
        'subcategory' => SubcategoryController::class,
        'courses' => CourseController::class,
        'students' => StudentController::class,
        'quizzes' => QuizController::class,
        'tests' => TestController::class,
        'offers' => OfferController::class,
        'queries' => QueryController::class,
        'studymaterialtypes' => StudyMaterialTypeController::class,
        'studymaterials' => StudymaterialController::class,
        'coursevideos' => CoursevideoController::class,
        'courserrs' => CourseRRController::class,
        'teacherrrs' => TeacherRRController::class,
        'soldcourses' => SoldcoursesController::class,
        'books' => BookController::class,
        'liveclasses' => LiveClassController::class,
        'completedcourses' => CourseCompletedController::class,
        'coursecertificates' => CourseCertificateController::class,
        'teachernotifications' => TeacherNotificationController::class,
        'adminnotifications' => AdminNotificationController::class,
    ]);

    Route::post('/coursevideos/chunked_upload', [CourseVideoController::class, 'chunkedUpload'])->name('coursevideos.chunked_upload');
    
    Route::get('/teachers-enrolled', [BackendController::class, 'teachers_enrolled'])->name('Teachers-Enrolled');
    Route::get('/students-enrolled', [BackendController::class, 'students_enrolled'])->name('Students-Enrolled');

    Route::get('/contacts', [BackendController::class, 'contacts'])->name('Contacts');
    Route::get('/contact-delete/{id}', [BackendController::class, 'contact_delete'])->name('Contact-Delete');
    Route::get('/quiz-reports', [BackendController::class, 'quizreport'])->name('Quiz-Reports');
    Route::get('/test-reports', [BackendController::class, 'testreport'])->name('Test-Reports');
    Route::get('/subjective-test-reports', [BackendController::class, 'subjectivetestreport'])->name('Subjective-Test-Reports');
    Route::get('/subjective-test-questions/{test_id}', [BackendController::class, 'subjectivetestquestions'])->name('Subjective-Test-Questions');
    Route::post('/subjective-test-answer', [BackendController::class, 'subjectivetestanswer'])->name('Subjective-Test-Answer');

    // Payments
    Route::get('/course-payments', [PaymentController::class, 'course_payments'])->name('Teacher-Course-Payments');
    Route::get('/quiz-payments', [PaymentController::class, 'quiz_payments'])->name('Teacher-Quiz-Payments');

    Route::get('/all-book-payments', [PaymentController::class, 'all_book_payments'])->name('Book-Payments');
    Route::post('/upload-book-tracking-detail/{id}', [PaymentController::class, 'upload_book_tracking_detail'])->name('Upload-Book-Tracking-Detail');
    Route::get('/teachers-course-payments', [PaymentController::class, 'teachers_course_payments'])->name('Teachers-Course-Payments');
    Route::get('/all-course-payments', [PaymentController::class, 'all_course_payments'])->name('Course-Payments');
    Route::post('/upload-course-payment-proof/{id}', [PaymentController::class, 'upload_course_payment_proof'])->name('Upload-Course-Payment-Proof');
    Route::get('/all-quiz-payments', [PaymentController::class, 'all_quiz_payments'])->name('Quiz-Payments');
    Route::post('/upload-quiz-payment-proof/{id}', [PaymentController::class, 'upload_quiz_payment_proof'])->name('Upload-Quiz-Payment-Proof');


    Route::get('join-meeting-page/{id}', [LiveClassController::class, 'join_meeting'])->name('Join-Meeting');


    // Agora Live Streaming
    Route::get('/meetings', [AgoraMeetingController::class, 'index'])->name('Agora-Meetings');
    Route::get('/create-meeting', [AgoraMeetingController::class, 'create'])->name('Create-Agora-Meeting');
    Route::post('/meetings', [AgoraMeetingController::class, 'store'])->name('Agora-Store-Meeting');
    Route::get('/edit-meeting/{id}', [AgoraMeetingController::class, 'edit'])->name('Agora-Edit-Meeting');
    Route::get('/meetings/{id}', [AgoraMeetingController::class, 'show'])->name('Agora-View-Meeting');
    Route::put('/meetings/{id}', [AgoraMeetingController::class, 'update'])->name('Agora-Update-Meeting');
    Route::delete('/meetings/{id}', [AgoraMeetingController::class, 'destroy'])->name('Agora-Delete-Meeting');
    Route::get('/token/{channelName}', [AgoraMeetingController::class, 'getToken']);
    Route::get('/rtmtoken', [AgoraMeetingController::class, 'getrtmToken']);

    Route::get('/join-agora-meeting/{channelName}', [AgoraMeetingController::class, 'join_meeting'])->name('Join-Agora-Meeting');

    Route::get('/my-profile', [ProfileController::class, 'my_profile'])->name('My-Profile');
    Route::get('/edit-profile', [ProfileController::class, 'edit_profile'])->name('Edit-Profile');
    Route::post('/update-prifile', [ProfileController::class, 'update_profile'])->name('Update-Profile');
    Route::post('/update-profile-image', [ProfileController::class, 'updateProfileImage'])->name('update-profile-image');
});

Route::get('/certificate', [StudentController::class, 'certificate']);

Route::get('/generate-certificate/{student_id}/{course_id}', [StudentController::class, 'generate_certificate'])->name('Generate-Certificate');
// Chat message 
Route::get('all-chat/{channel_name}', [ChatController::class, 'all_chat'])->name('All-Chat');
Route::post('store-chat', [ChatController::class, 'store_chat'])->name('Store-Chat');

// Joined Users
Route::get('all-users/{channel_name}', [JoinedUserController::class, 'all_users'])->name('All-Users');

// Closed meeting routes
Route::delete('reset-chats/{channel_name}', [AgoraMeetingController::class, 'reset_chats']);
Route::delete('reset-users/{channel_name}', [AgoraMeetingController::class, 'reset_users']);

Route::post('/update-teacher-status', [TeacherController::class, 'update_teacher_status'])->name('update-teacher-status');
Route::post('/update-joining-status', [AgoraMeetingController::class, 'update_joining_status'])->name('update-joining-status');
Route::post('/update-student-status', [StudentController::class, 'update_student_status'])->name('update-student-status');
Route::post('/update-courserr-status', [CourseRRController::class, 'update_courserr_status'])->name('update-courserr-status');
Route::post('/update-teacherrr-status', [TeacherRRController::class, 'update_teacherrr_status'])->name('update-teacherrr-status');
Route::get('/get-subcategories/{categoryId}', [CourseController::class, 'get_subcategories']);
Route::get('/get-courses-by-subcategory/{subcategoryId}', [CourseController::class, 'get_courses_by_subcategory']);
Route::get('/get-quiz-by-subcategory/{subcategoryId}', [QuizController::class, 'get_quiz_by_subcategory']);




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
