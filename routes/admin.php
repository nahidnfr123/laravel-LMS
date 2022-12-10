<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ClasAttendanceController;
use App\Http\Controllers\ClasController;
use App\Http\Controllers\CommunityCategoryController;
use App\Http\Controllers\CommunityPostController;
use App\Http\Controllers\CommunityTagsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LiveClassController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\McqController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/batch/{id}/report', [BatchController::class, 'report'])->name('admin.batch.report');
Route::middleware('auth', 'admin-teacher', 'permission:access_dashboard')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    ////// *** ///////
    Route::resource('/subject', SubjectController::class)->middleware('permission:view_subject')->name('*', 'subject');
    Route::resource('/semester', SemesterController::class)->middleware('permission:view_semester')->name('*', 'semester');
    Route::get('/batch/{id}/students', [BatchController::class, 'students'])->middleware('permission:view_student')->name('batch.students');
//    Route::get('/batch/{id}/report', [BatchController::class, 'report'])->name( 'batch.report');
    Route::get('/batch/{id}/add-mark', [BatchController::class, 'addMark'])->name('batch.addMark');
    Route::get('/batch/{id}/add-attendance', [BatchController::class, 'addAttendance'])->name('batch.addAttendance');
    Route::resource('/batch', BatchController::class)->middleware('permission:view_batch')->name('*', 'batch');
    Route::resource('/topic', TopicController::class)->middleware('permission:view_topic')->name('*', 'topic');
//    Route::resource('/clas', ClasController::class)->name('*', 'clas');
    Route::resource('/marks', MarkController::class)->middleware('permission:view_mark')->name('*', 'marks');
    Route::resource('/clas-attendance', ClasAttendanceController::class)->middleware('permission:attendance_mark')->name('*', 'clas-attendance');
    ////// *** ///////

    Route::get('/user/{id}/manage', [UserController::class, 'manage'])->name('user.manage');
    Route::post('/user/{id}/manageUpdate', [UserController::class, 'manageUpdate'])->name('user.manageUpdate');
    Route::resource('/user', UserController::class)->middleware('permission:view_user')->name('*', 'user');

//    Route::get('/course', [\App\Http\Controllers\CourseController::class, 'adminIndex']);
    Route::resource('/course', CourseController::class)->middleware('permission:view_course')->name('*', 'course');
    Route::resource('/section', SectionController::class)->name('*', 'section');
    Route::resource('/content', ContentController::class)->name('*', 'content');
    Route::get('/exam/{id}/ranking', [ExamController::class, 'ranking'])->name('exam.ranking');
    Route::resource('/exam', ExamController::class)->name('*', 'exam');
    Route::post('/mcq-import', [McqController::class, 'import'])->name('mcq-import');
    Route::resource('/mcq', McqController::class)->name('*', 'mcq');
    Route::resource('/assignment', AssignmentController::class)->name('*', 'assignment');
    Route::resource('/live_class', LiveClassController::class)->name('*', 'live_class');

    Route::resource('/community_category', CommunityCategoryController::class)->middleware('permission:view_community_category')->name('*', 'community_category');
    Route::resource('/community_tags', CommunityTagsController::class)->middleware('permission:view_community_tag')->name('*', 'community_tags');
    Route::resource('/community_post', CommunityPostController::class)->middleware('permission:view_community_post')->name('*', 'community_post');

    Route::get('/orders/{id}/accept', [OrderController::class, 'accept'])->name('orders.accept');
    Route::get('/orders/{id}/reject', [OrderController::class, 'reject'])->name('orders.reject');
    Route::resource('/orders', OrderController::class)->middleware('permission:view_order')->name('*', 'orders');

    Route::resource('/content-us', ContactUsController::class)->middleware('permission:view_contact')->name('*', 'content-us');
    Route::post('/import-user', [ImportController::class, 'user'])->name('importUser');
    Route::post('/import-mark', [ImportController::class, 'mark'])->name('importMark');
    Route::post('/import-attendance', [ImportController::class, 'attendance'])->name('importAttendance');
});
