<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
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
Route::get('/events', [FrontendController::class, 'events'])->name('Events');
Route::get('/donate-blood', [FrontendController::class, 'donate_blood'])->name('Donate-Blood');
Route::post('/store-blood-donation', [FrontendController::class, 'store_blood_donation'])->name('Store-Blood-Donation');
Route::get('/request-blood', [FrontendController::class, 'request_blood'])->name('Request-Blood');
Route::post('/store-blood-request', [FrontendController::class, 'store_blood_request'])->name('Store-Blood-Request');
Route::get('/become-member', [FrontendController::class, 'become_member'])->name('Become-Member');
Route::post('/store-member', [FrontendController::class, 'store_member'])->name('Store-Member');


Route::get('/privacy-policy', [FrontendController::class, 'privacy_policy'])->name('Privacy-Policy');
Route::get('/terms-&-conditions', [FrontendController::class, 'terms'])->name('Terms-Conditions');


Route::prefix('Panel')->middleware(['auth', 'checkstatus'])->group(function () {
    Route::get('/dashboard', [BackendController::class, 'index'])->name('Admin-Dashboard');
    Route::get('/donors', [BackendController::class, 'donors'])->name('All-Donors');
    Route::get('/blood_requests', [BackendController::class, 'blood_requests'])->name('All-Blood-Requests');
    Route::get('/members', [BackendController::class, 'members'])->name('All-Members');
    Route::post('/update-last-donation-date', [FrontendController::class, 'update_last_donation_date'])->name('Update-Last-Donation-Date');

    Route::resources([
     
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
