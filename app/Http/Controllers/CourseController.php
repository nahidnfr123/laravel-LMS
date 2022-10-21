<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $prefix = $request->route()->getPrefix();
        if ($prefix === '/admin' || $prefix === 'admin/' || $prefix === 'admin') {
            abort_if(!auth()->user()->can('view_course'), 403);
            $courses = Course::all();
            return view('admin.course.index', compact('courses'));
        }

        $courses = Course::where('status', true)->get();
        return view('course.index', compact('courses'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $course = new Course();
        $action = URL::route('admin.course.store');
        return view('admin.course.form', compact('course', 'action'));
    }

    public function enroll($id): View|Factory|Application
    {
        $course = \App\Models\Course::findOrFail($id);
        if (!$course->discounted_price && !$course->price) { # Free Course ...
            $course->users()->attach(auth()->id());
        } else { # Paid course ...

        }
        return view('course.show', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCourseRequest $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['photo']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->photoUploader($request->file('photo'));
        }
        Course::create($data);
        return redirect()->route('admin.course.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Course $course
     * @return Application|Factory|View
     */
    public function show(Course $course): View|Factory|Application
    {
        $course->load('sections');
        return view('admin.course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
     * @return Application|Factory|View
     */
    public function edit(Course $course): View|Factory|Application
    {
        $action = URL::route('admin.course.update', $course->id);
        return view('admin.course.form', compact('course', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCourseRequest $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $data = $request->validated();
        unset($data['photo']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->photoUploader($request->file('photo'));
        }
        $course->update($data);
        return redirect()->route('admin.course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return RedirectResponse
     */
    public function destroy(Course $course): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_course'), 403);
        $course->delete();
        return redirect()->back();
    }
}
