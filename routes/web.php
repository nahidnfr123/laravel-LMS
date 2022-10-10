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

Route::get('/', function () {
    return view('index');
});

Route::get('/courses', function () {
    $courses = \App\Models\Course::where('status', true)->get();
    return view('course.index', compact('courses'));
})->name('home.courses');

Route::get('/course/{id}', function ($id) {
    $course = \App\Models\Course::findOrFail($id);
    return view('course.show', compact('course'));
})->name('home.course');

Route::get('/my-courses', function () {
    return view('index');
});

Route::get('/profile', function () {
    return view('index');
});

Route::get('/add-to-cart', function () {
    return view('index');
});

Route::get('/order', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
