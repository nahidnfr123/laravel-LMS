<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');
//    Route::get('/course', [\App\Http\Controllers\CourseController::class, 'adminIndex']);
    Route::resource('/course', \App\Http\CourseController::class)->name('*', 'course');
    Route::resource('/section', \App\Http\SectionController::class)->name('*', 'section');
    Route::resource('/content', \App\Http\ContentController::class)->name('*', 'content');
    Route::resource('/exam', \App\Http\ExamController::class)->name('*', 'exam');
    Route::post('/mcq-import', [\App\Http\McqController::class, 'import'])->name('mcq-import');
    Route::resource('/mcq', \App\Http\McqController::class)->name('*', 'mcq');
});
