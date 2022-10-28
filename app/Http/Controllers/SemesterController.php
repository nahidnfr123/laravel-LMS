<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $semesters = Semester::all();
        return view('admin.semester.index', compact('semesters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $subjects = Subject::all();
        $semester = new Semester();
        $action = URL::route('admin.semester.store');
        return view('admin.semester.form', compact('semester', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSemesterRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSemesterRequest $request): RedirectResponse
    {
        Semester::create($request->validated());
        return redirect()->route('admin.semester.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Semester $semester
     * @return \Illuminate\Http\Response
     */
    public function show(Semester $semester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Semester $semester
     * @return Application|Factory|View
     */
    public function edit(Semester $semester)
    {
        $action = URL::route('admin.semester.update', $semester->id);
        return view('admin.semester.form', compact('semester', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSemesterRequest $request
     * @param Semester $semester
     * @return RedirectResponse
     */
    public function update(UpdateSemesterRequest $request, Semester $semester): RedirectResponse
    {
        $semester->update($request->validated());
        return redirect()->route('admin.semester.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Semester $semester
     * @return RedirectResponse
     */
    public function destroy(Semester $semester): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_semester'), 403);
        $semester->delete();
        return redirect()->back();
    }
}
