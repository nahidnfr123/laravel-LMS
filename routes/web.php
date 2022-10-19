<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CommunityPostController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ReviewController;
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

Route::get('/', function () {
    return view('index');
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
    Route::get('/messages', [ExamController::class, 'ranking'])->name('home.messages');

    Route::get('/my-courses', function () {
        $courses = auth()->user()->courses;
        return view('user.mycourses', compact('courses'));
    })->name('home.my_courses');

    Route::get('/profile', function () {
        $courses = auth()->user()->courses;
        return view('user.profile', compact('courses'));
    })->name('home.profile');
});


Route::resource('/community_post', CommunityPostController::class)->name('*', 'community_post');

Route::get('/order', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/payment.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
