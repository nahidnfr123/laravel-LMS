<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBatchRequest;
use App\Http\Requests\UpdateBatchRequest;
use App\Models\Batch;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $semester = null;
        if (request('semester_id')) {
            $semester = Semester::findOrFail(request('semester_id'));
            $batch = Batch::where('semester_id', request('semester_id'))->get();
        } else {
            $batch = Batch::all();
        }
        return view('admin.batch.index', compact('batch', 'semester'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $batch = new Batch();
        $semesters = Semester::all();
        $subjects = Subject::all();
        $action = URL::route('admin.batch.store');
        return view('admin.batch.form', compact('batch', 'semesters', 'subjects', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBatchRequest $request
     * @return RedirectResponse
     */
    public function store(StoreBatchRequest $request): RedirectResponse
    {
        Batch::create($request->validated());
        return redirect()->route('admin.batch.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Batch $batch
     * @return Application|Factory|View
     */
    public function show(Batch $batch): View|Factory|Application
    {
        return view('admin.batch.show', compact('batch'));
    }

    public function students($id): View|Factory|Application
    {
        $batch = Batch::findOrFail($id);
//        $batch = Batch::where('id', $id)->with('users', 'user.topic')->get();
        return view('admin.batch.students', compact('batch'));
    }

    public function addMark(Request $request, $id): View|Factory|Application
    {
        if ($request->isMethod('post')) {
            print('is post method');
        }
        $semesters = Semester::all();
        $subjects = Subject::all();
        $batch = Batch::findOrFail($id);
        $action = URL::route('admin.batch.addMark', $batch->id);
        return view('admin.batch.addMark', compact('batch', 'action', 'semesters', 'subjects'));
    }

    public function addAttendance($id): View|Factory|Application
    {
        $batch = Batch::findOrFail($id);
        return view('admin.batch.addAttendance', compact('batch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Batch $batch
     * @return Application|Factory|View
     */
    public function edit(Batch $batch): View|Factory|Application
    {
        $semesters = Semester::all();
        $subjects = Subject::all();
        $action = URL::route('admin.batch.update', $batch->id);
        return view('admin.batch.form', compact('batch', 'semesters', 'subjects', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBatchRequest $request
     * @param Batch $batch
     * @return RedirectResponse
     */
    public function update(UpdateBatchRequest $request, Batch $batch): RedirectResponse
    {
        $batch->update($request->validated());
        return redirect()->route('admin.topic.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Batch $batch
     * @return RedirectResponse
     */
    public function destroy(Batch $batch): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_batch'), 403);
        $batch->delete();
        return redirect()->back();
    }
}
