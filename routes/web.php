<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


//admin 전용 page
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;            


//user 전용 page
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\UserRegisterController;

// //email 검증 핸들러
// use Illuminate\Foundation\Auth\EmailVerificationRequest;

// //email 검증 재발송
// use Illuminate\Http\Request;


//admin 전용 Route
Route::get('/admin', function () {return redirect('/admin/dashboard');})->middleware('auth');
Route::get('/admin/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/admin/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/admin/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
// Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
// Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
// Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
// Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/admin/{page}', [PageController::class, 'index'])->name('page');
	Route::get('/admin/{page}/print/{num}', [PageController::class, 'print'])->name('page.print');
	Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');
});

//user 전용 Route
Route::get('/user', function () {return redirect('/user/tables');})->middleware(['userauth', 'verify_email']);
Route::get('/user/register', [UserRegisterController::class, 'create'])->middleware('guest')->name('userregister');
Route::post('/user/register', [UserRegisterController::class, 'registration'])->middleware('guest')->name('userregister.perform');
Route::get('/user/login', [UserLoginController::class, 'show'])->middleware('guest')->name('userlogin');
Route::post('/user/login', [UserLoginController::class, 'login'])->middleware('guest')->name('userlogin.perform');
Route::get('/user/dashboard', [UserHomeController::class, 'index'])->name('userhome')->middleware('verify_email');

Route::group(['middleware' => 'userauth'], function () {
	Route::get('/user/{page}', [UserPageController::class, 'index'])->name('userpage');
	Route::get('/user/{page}/register', [UserPageController::class, 'register'])->name('userpage.register');
	Route::post('/user/{page}/register', [UserPageController::class, 'register_insert'])->name('userpage.insert');
	Route::get('/user/{page}/modify/{num}', [UserPageController::class, 'modify'])->name('userpage.modify');
	Route::post('/user/{page}/modify/{num}', [UserPageController::class, 'modify_update'])->name('userpage.update');
	Route::post('/user/logout', [UserLoginController::class, 'logout'])->name('userlogout');
});

// //email 검증 링크 발송
// Route::get('/email/verify', function() {
// 	return view('auth.user.verify-email');
// })->middleware('userauth')->name('verification.notice');

// //email 검증 핸들러
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();

//     return redirect('/user/tables');
// })->middleware(['userauth', 'signed'])->name('verification.verify');

// //email 검증 재발송
// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//email 검증 관련 Route
Route::get('/user/account/verify/{token}', [UserRegisterController::class, 'verifyAccount'])->name('userregister.verify'); 