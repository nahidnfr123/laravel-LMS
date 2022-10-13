<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Models\Assignment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function upload(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'content_id' => 'required',
            'assignment_id' => 'required',
            'file' => 'required|file|mimes:pdf',
        ]);
        $assignment = Assignment::findOrFail($id);
        $file = $request->file;
        if ($request->hasFile('file')) {
            $path = $file->store('public/uploads/assignments');
            $fileUploaded = str_replace('public', '/storage', $path) ?? $path;
            $assignment->users()->attach(auth()->id(), ['file' => $fileUploaded]);
        }
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreAssignmentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssignmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Assignment $assignment
     * @return Application|Factory|View
     */
    public function show(Assignment $assignment): View|Factory|Application
    {
        $content = $assignment->content;
        return view('admin.course.content.assignment.index', compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Assignment $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateAssignmentRequest $request
     * @param \App\Models\Assignment $assignment
     * @return RedirectResponse
     */
    public function update(UpdateAssignmentRequest $request, Assignment $assignment): RedirectResponse
    {
        $assignment->users()->updateExistingPivot($request->user_id, ['marks' => $request->marks]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Assignment $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
