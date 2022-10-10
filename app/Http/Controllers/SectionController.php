<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $section = new Section();
        $action = URL::route('admin.section.store');
        return view('admin.course.section.form', compact('section', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectionRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSectionRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Section::create($data);
        return redirect()->route('admin.course.show', $data['course_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param Section $section
     * @return Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Section $section
     * @return Application|Factory|View
     */
    public function edit(Section $section): View|Factory|Application
    {
        $action = URL::route('admin.section.update', $section->id);
        return view('admin.course.section.form', compact('section', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param Section $section
     * @return RedirectResponse
     */
    public function update(UpdateSectionRequest $request, Section $section): RedirectResponse
    {
        $data = $request->validated();
        $section->update($data);
        return redirect()->route('admin.course.show', $data['course_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Section $section
     * @return RedirectResponse
     */
    public function destroy(Section $section): RedirectResponse
    {
        $section->delete();
        return redirect()->back();
    }
}
