<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\McqController;
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
    Route::resource('/exam', ExamController::class)->name('*', 'exam');
    Route::post('/mcq-import', [McqController::class, 'import'])->name('mcq-import');
    Route::resource('/mcq', McqController::class)->name('*', 'mcq');
    Route::resource('/assignment', AssignmentController::class)->name('*','assignment');
});
