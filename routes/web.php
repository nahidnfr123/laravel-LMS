<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CommunityPostController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Models\Batch;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/test', function () {
    $batch = Batch::where('id', 1)->with('users', 'users.topics', 'users.marks')->first();
    return $batch->users;
});

Route::get('/', function () {
    $users = \App\Models\User::where('role', 'student')->get();
    $courses = \App\Models\Course::where('status', true)->get();
    return view('index', compact('courses', 'users'));
})->name('home');

Route::get('/courses', function () {
    $courses = \App\Models\Course::where('status', true)->get();
    return view('course.index', compact('courses'));
})->name('home.courses');

Route::get('/course/{id}', function ($id) {
    $course = \App\Models\Course::findOrFail($id);
    return view('course.show', compact('course'));
})->name('home.course');

Route::middleware('auth')->group(function () {
    Route::get('/course/{id}/enroll', [CourseController::class, 'enroll'])->name('home.course.enroll');
    Route::post('/assignment/{id}/upload', [AssignmentController::class, 'upload'])->name('home.assignment.upload');
    Route::get('/attendance', [AttendanceController::class, 'store'])->name('home.attendance.store');
    Route::post('/review', [ReviewController::class, 'store'])->name('home.review.store');
    Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('home.review.destroy');
    Route::get('/exam/{exam}', [ExamController::class, 'show'])->name('home.exam.show');
    Route::post('/exam', [ExamController::class, 'store'])->name('home.exam.store');
    Route::get('/exam/{id}/ranking', [ExamController::class, 'ranking'])->name('home.exam.ranking');

    Route::get('/my-courses', function () {
        $courses = auth()->user()->courses;
        return view('user.mycourses', compact('courses'));
    })->name('home.my_courses');

    Route::get('/profile', [UserController::class, 'show'])->name('home.profile.show');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('home.profile.edit');
    Route::put('/profile/update', [UserController::class, 'update'])->name('home.profile.update');
    Route::get('/profile/password', [UserController::class, 'passwordEdit'])->name('home.profile.passwordEdit');
    Route::put('/profile/password', [UserController::class, 'passwordUpdate'])->name('home.profile.passwordUpdate');
});


Route::resource('/community_post', CommunityPostController::class)->name('*', 'community_post');
Route::resource('/content-us', ContactUsController::class)->name('*', 'content-us');

Route::get('/order', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/payment.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
