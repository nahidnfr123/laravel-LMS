<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $topic = Topic::all();
        return view('admin.topic.index', compact('topic'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $semester_id = request('semester_id') ?? 0;
        $semester = Semester::findOrFail($semester_id);
        $topic = new Topic();
        $action = URL::route('admin.topic.store');
        return view('admin.topic.form', compact('semester', 'topic', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTopicRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTopicRequest $request): RedirectResponse
    {
        $topic = Topic::create($request->validated());
        return redirect()->route('admin.semester.show', $topic->semester_id);
    }

    /**
     * Display the specified resource.
     *
     * @param Topic $topic
     * @return Application|Factory|View
     */
    public function show(Topic $topic): View|Factory|Application
    {
        return view('admin.topic.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Topic $topic
     * @return Application|Factory|View
     */
    public function edit(Topic $topic): View|Factory|Application
    {
        $semester = Semester::findOrFail($topic->semester_id);
        $action = URL::route('admin.semester.update', $semester->id);
        return view('admin.topic.form', compact('topic', 'semester', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTopicRequest $request
     * @param Topic $topic
     * @return RedirectResponse
     */
    public function update(UpdateTopicRequest $request, Topic $topic): RedirectResponse
    {
        $topic->update($request->validated());
        return redirect()->route('admin.semester.show', $topic->semester_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Topic $topic
     * @return RedirectResponse
     */
    public function destroy(Topic $topic): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_topic'), 403);
        $topic->delete();
        return redirect()->back();
    }
}
