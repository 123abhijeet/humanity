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
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('Gallery');
Route::get('/events', [FrontendController::class, 'events'])->name('Events');
Route::get('/donate-now', [FrontendController::class, 'donate_now'])->name('Donate-Now');
Route::get('/request-blood', [FrontendController::class, 'request_blood'])->name('Request-Blood');
Route::get('/our-sponsers', [FrontendController::class, 'our_sponsers'])->name('Our-Sponsers');
Route::get('/become-member', [FrontendController::class, 'become_member'])->name('Become-Member');
Route::post('/store-member', [FrontendController::class, 'store_member'])->name('Store-Member');


Route::get('/privacy-policy', [FrontendController::class, 'privacy_policy'])->name('Privacy-Policy');
Route::get('/terms-&-conditions', [FrontendController::class, 'terms'])->name('Terms-Conditions');


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
    ]);

    Route::get('/contacts', [BackendController::class, 'contacts'])->name('Contacts');
    Route::get('/contact-delete/{id}', [BackendController::class, 'contact_delete'])->name('Contact-Delete');

    Route::get('/my-profile', [ProfileController::class, 'my_profile'])->name('My-Profile');
    Route::get('/edit-profile', [ProfileController::class, 'edit_profile'])->name('Edit-Profile');
    Route::post('/update-prifile', [ProfileController::class, 'update_profile'])->name('Update-Profile');
    Route::post('/update-profile-image', [ProfileController::class, 'updateProfileImage'])->name('update-profile-image');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
