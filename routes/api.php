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

});


Route::middleware('auth:sanctum')->group(function () {
    
});
