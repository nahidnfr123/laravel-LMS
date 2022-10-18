<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CommunityCategoryController;
use App\Http\Controllers\CommunityPostController;
use App\Http\Controllers\CommunityTagsController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\LiveClassController;
use App\Http\Controllers\McqController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');
//    Route::get('/course', [\App\Http\Controllers\CourseController::class, 'adminIndex']);
    Route::resource('/course', CourseController::class)->name('*', 'course');
    Route::resource('/section', SectionController::class)->name('*', 'section');
    Route::resource('/content', ContentController::class)->name('*', 'content');
    Route::get('/exam/{id}/ranking', [ExamController::class, 'ranking'])->name('exam.ranking');
    Route::resource('/exam', ExamController::class)->name('*', 'exam');
    Route::post('/mcq-import', [McqController::class, 'import'])->name('mcq-import');
    Route::resource('/mcq', McqController::class)->name('*', 'mcq');
    Route::resource('/assignment', AssignmentController::class)->name('*', 'assignment');
    Route::resource('/live_class', LiveClassController::class)->name('*', 'live_class');

    Route::resource('/community_category', CommunityCategoryController::class)->name('*', 'community_category');
    Route::resource('/community_tags', CommunityTagsController::class)->name('*', 'community_tags');
    Route::resource('/community_post', CommunityPostController::class)->name('*', 'community_post');

    Route::get('/orders/{id}/accept', [OrderController::class, 'accept'])->name('orders.accept');
    Route::get('/orders/{id}/reject', [OrderController::class, 'reject'])->name('orders.reject');
    Route::resource('/orders', OrderController::class)->name('*', 'orders');
});
