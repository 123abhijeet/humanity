<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CourseVideoController;
use App\Http\Controllers\Api\ObjectiveTestController;
use App\Http\Controllers\Api\PaymentHistoryController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\ReviewRatingController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\StudyMaterialController;
use App\Http\Controllers\Api\SubjectiveTestController;
use App\Http\Controllers\Api\TeacherProfileController;
use App\Http\Controllers\Api\ZoomController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Teacher\AgoraMeetingController;
use App\Http\Controllers\Teacher\ChatController;
use App\Http\Controllers\Teacher\JoinedUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/get_subcategory_data', [StudentController::class, 'get_subcategory_data']);
Route::post('/store_student_info', [StudentController::class, 'store_student_info']);


Route::get('/logo', [StudentController::class, 'logo']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/get_teachers', [StudentController::class, 'get_teachers']);
    // Books 
    Route::get('/get_books', [BookController::class, 'get_books']);
    Route::get('/get_book_by_id/{book_id}', [BookController::class, 'get_book_by_id']);
    Route::post('/get-book-detail', [BookController::class, 'get_book_detail']);
    Route::post('/store_book_payment', [BookController::class, 'store_book_payment']);
    Route::get('/search-book', [BookController::class, 'search_book']);

    Route::get('/get_profile', [ProfileController::class, 'get_profile']);
    Route::post('/update_profile', [ProfileController::class, 'update_profile']);

    // Courses Api's
    Route::get('/get_courses', [CourseController::class, 'get_courses']);
    Route::get('/get_course_by_id/{course_id}', [CourseController::class, 'get_course_by_id']);
    Route::get('/get_recommended_courses', [CourseController::class, 'get_recommended_courses']);
    Route::post('/course-payment', [CourseController::class, 'course_payment']);
    Route::post('/installment-order-details', [CourseController::class, 'installment_order_details']);
    Route::post('/installment-payment', [CourseController::class, 'installment_payment']);
    Route::get('my-courses', [CourseController::class, 'my_courses']);
    Route::get('my-course-details/{course_id}', [CourseController::class, 'my_course_details']);
    Route::get('/course-purchase-status/{id}', [CourseController::class, 'course_purchase_status']);
    Route::post('/payment-type', [CourseController::class, 'payment_type']);
    Route::post('/check-payment-status', [CourseController::class, 'check_payment_status']);

    // Quiz Api's
    Route::get('/get_paid_quizzes', [QuizController::class, 'get_paid_quizzes']);
    Route::get('/get_quiz_subjects', [QuizController::class, 'get_quiz_subjects']);
    Route::get('/get_quiz_by_subjects', [QuizController::class, 'get_quiz_by_subjects']);
    Route::get('/get_quiz_teachers', [QuizController::class, 'get_quiz_teachers']);
    Route::get('/get_quiz_by_teachers', [QuizController::class, 'get_quiz_by_teachers']);
    Route::get('/get_quiz_questions/{quiz_id}', [QuizController::class, 'get_quiz_questions']);
    Route::post('/next_question', [QuizController::class, 'next_question']);
    Route::get('/all_attempted_questions/{quiz_id}', [QuizController::class, 'all_attempted_questions']);
    Route::post('/submit_quiz', [QuizController::class, 'submit_quiz']);
    Route::get('/get_quiz_result/{quiz_id}', [QuizController::class, 'get_quiz_result']);
    Route::get('/get_all_quiz_result', [QuizController::class, 'get_all_quiz_result']);
    Route::post('/quiz-payment', [QuizController::class, 'quiz_payment']);
    Route::post('/purchase-quiz', [QuizController::class, 'purchase_quiz']);
    Route::get('/quiz-purchase-status/{id}', [QuizController::class, 'quiz_purchase_status']);
    Route::get('/quiz-history', [QuizController::class, 'quiz_history']);
    Route::get('/all-quiz', [QuizController::class, 'all_quiz']);

    Route::get('/reset-previous-quiz/{quiz_id}',[QuizController::class,'reset_previous_quiz']);
    Route::get('/reset-previous-objective-test/{test_id}',[ObjectiveTestController::class,'reset_previous_objective_test']);
    Route::get('/reset-previous-subjective-test/{test_id}',[SubjectiveTestController::class,'reset_previous_subjective_test']);

    // Objective Test Api's
    Route::get('/get_demo_test', [ObjectiveTestController::class, 'get_demo_test']);
    Route::get('/get_test_subjects', [ObjectiveTestController::class, 'get_test_subjects']);
    Route::get('/get_objective_test_by_subjects', [ObjectiveTestController::class, 'get_objective_test_by_subjects']);
    Route::get('/get_test_questions/{test_id}', [ObjectiveTestController::class, 'get_test_questions']);
    Route::post('/next_objective_test_question', [ObjectiveTestController::class, 'next_objective_test_question']);
    Route::get('/all_attempted_objective_test_questions/{test_id}', [ObjectiveTestController::class, 'all_attempted_objective_test_questions']);
    Route::post('/submit_objective_test', [ObjectiveTestController::class, 'submit_objective_test']);
    Route::get('/get_objective_test_result', [ObjectiveTestController::class, 'get_objective_test_result']);
    Route::get('/get_all_objective_test_result', [ObjectiveTestController::class, 'get_all_objective_test_result']);
    Route::get('/objective-test-history', [ObjectiveTestController::class, 'objective_test_history']);
    Route::get('/all-objective-test/{course_id}', [ObjectiveTestController::class, 'all_objective_test']);

    // Subjective Test Api's
    Route::get('/get_subjective_test_by_subjects', [SubjectiveTestController::class, 'get_subjective_test_by_subjects']);
    Route::get('/get_subjective_test_questions/{test_id}', [SubjectiveTestController::class, 'get_subjective_test_questions']);
    Route::post('/next_subjective_test_question', [SubjectiveTestController::class, 'next_subjective_test_question']);
    Route::get('/all_attempted_subjective_test_questions/{test_id}', [SubjectiveTestController::class, 'all_attempted_subjective_test_questions']);
    Route::post('/submit_subjective_test', [SubjectiveTestController::class, 'submit_subjective_test']);
    Route::get('/get_subjective_test_result', [SubjectiveTestController::class, 'get_subjective_test_result']);
    Route::get('/get_all_subjective_test_result', [SubjectiveTestController::class, 'get_all_subjective_test_result']);
    Route::get('/subjective-test-history', [SubjectiveTestController::class, 'subjective_test_history']);
    Route::get('/all-subjective-test/{course_id}', [SubjectiveTestController::class, 'all_subjective_test']);

    // Study Material Api's
    Route::get('/get_material_type', [StudyMaterialController::class, 'get_material_type']);
    Route::get('/get_study_material/{type}/{course_id}', [StudyMaterialController::class, 'get_study_material']);
    Route::get('/get_study_material_chapters/{course_id}/{subject}', [StudyMaterialController::class, 'get_study_material_chapters']);

    // Search Course
    Route::get('/search-course', [CourseController::class, 'search_course']);

    // Ask Question Api's
    Route::post('/ask-question', [StudentController::class, 'ask_question']);
    Route::get('/all-asked-questions', [StudentController::class, 'all_asked_questions']);
    Route::get('/asked-question-details/{question_id}', [StudentController::class, 'asked_question_details']);

    // Course Review and Rating
    Route::get('/course-review-rating/{id}', [ReviewRatingController::class, 'course_review_rating']);
    Route::post('/store-course-rating-review', [ReviewRatingController::class, 'store_course_rating_review']);

    // Teacher Review and Rating
    Route::get('/teacher-review-rating/{id}', [ReviewRatingController::class, 'teacher_review_rating']);
    Route::post('/store-teacher-rating-review', [ReviewRatingController::class, 'store_teacher_rating_review']);

    // Payment History
    Route::get('/all-payments-course', [PaymentHistoryController::class, 'all_payments_course']);
    Route::get('/all-payments-books', [PaymentHistoryController::class, 'all_payments_books']);
    Route::get('/all-payments-quiz', [PaymentHistoryController::class, 'all_payments_quiz']);

    Route::get('/download-payment-detail/{id}', [PaymentHistoryController::class, 'download_payment_detail']);

    // Teacher Profile 
    Route::get('/teacher-profile/{id}', [TeacherProfileController::class, 'teacher_profile']);
    Route::get('/check-course-for-teacher/{id}', [TeacherProfileController::class, 'check_course_for_teacher']);
    Route::get('/check-teacher-rating-status/{id}', [TeacherProfileController::class, 'check_teacher_rating_status']);

    Route::get('get_course_subjects', [StudentController::class, 'get_course_subjects']);
    Route::get('get_books_subjects', [BookController::class, 'get_books_subjects']);

    // Offer
    Route::get('/offers', [StudentController::class, 'get_offers']);

    // Verify Coupon Code
    Route::get('/verify-course-coupon-code/{code}/{course_id}', [StudentController::class, 'verify_course_coupon_code']);
    Route::get('/verify-quiz-coupon-code/{code}/{quiz_id}', [StudentController::class, 'verify_quiz_coupon_code']);

    // Curriculum
    Route::get('/get-curriculum/{course_id}', [CourseVideoController::class, 'get_curriculum']);

    // Video Viewed Time
    Route::post('/store-last-viewed-time/{video_id}', [CourseVideoController::class, 'store_last_viewed_time']);

     // Resume course video
    Route::get('/check-resume-video',[CourseVideoController::class,'check_resume_video']);
    Route::get('/resume-course-video',[CourseVideoController::class,'resume_course_video']);

    Route::get('get_course_by_subjects', [StudentController::class, 'get_course_by_subjects']);

    // Route::get('/get-all-live-classes',[ZoomController::class,'get_all_live_classes']);
    // Route::get('/get-live-class/{meeting_id}',[ZoomController::class,'get_live_class']);
    
    Route::get('/get-all-live-classes',[AgoraMeetingController::class,'get_all_live_classes']);
    Route::get('/get-live-class/{channel_name}',[AgoraMeetingController::class,'get_live_class']);
    
    Route::post('/send-message',[AgoraMeetingController::class,'send_message']);
    
    // Chat message 
    Route::get('all-chat/{channel_name}', [ChatController::class, 'all_chat_api']);
    Route::post('store-chat', [ChatController::class, 'store_chat_api']);
    
    // Joined Users
    Route::post('store-user', [JoinedUserController::class, 'store_user']);
    Route::post('delete-user', [JoinedUserController::class, 'delete_user']);
    
    Route::get('get_books_by_subjects', [BookController::class, 'get_books_by_subjects']);
    Route::get('get_teachers_subjects', [StudentController::class, 'get_teachers_subjects']);

    // Certificates
    Route::get('/get-certificates', [StudentController::class, 'get_certificates']);
    Route::get('/get_certificate_details/{id}', [StudentController::class, 'get_certificate_details']);
    Route::get('/download-certificate/{course_id}',[StudentController::class, 'download_certificate']);
    
    // Quiz Winner
    Route::get('/get-quiz-winners', [QuizController::class, 'get_quiz_winners']);
    
    Route::get('/generate-certificate/{course_id}',[StudentController::class,'generate_certificate']);
});


Route::get('/category-list', [StudentController::class, 'get_category']);
Route::get('/subcategory-list/{category_id}', [StudentController::class, 'get_subcategory']);


Route::post('/create-meeting', [ZoomController::class, 'createMeeting']);
Route::post('/generate-signature', [ZoomController::class, 'generateSignature']);


Route::get('/meetings', [AgoraMeetingController::class, 'index']);
Route::post('/meetings', [AgoraMeetingController::class, 'store']);
Route::get('/meetings/{id}', [AgoraMeetingController::class, 'show']);
Route::put('/meetings/{id}', [AgoraMeetingController::class, 'update']);
Route::delete('/meetings/{id}', [AgoraMeetingController::class, 'destroy']);
Route::get('/token/{channelName}', [AgoraMeetingController::class, 'getToken']);
