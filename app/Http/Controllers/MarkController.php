<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarkRequest;
use App\Http\Requests\UpdateMarkRequest;
use App\Models\Batch;
use App\Models\Mark;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class MarkController extends Controller
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
        $user = User::findOrFail(request('user_id'));
        $batch = Batch::findOrFail(request('batch_id'));
        $topic = $batch->semester->topic->where('id', request('topic_id'))->first();

        return view('admin.users.addMarks', compact('batch', 'user', 'topic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMarkRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMarkRequest $request): RedirectResponse
    {
        $mark = Mark::create($request->validated());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Mark $mark
     * @return Response
     */
    public function show(Mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Mark $mark
     * @return Response
     */
    public function edit(Mark $mark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateMarkRequest $request
     * @param Mark $mark
     * @return Response
     */
    public function update(UpdateMarkRequest $request, Mark $mark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Mark $mark
     * @return RedirectResponse
     */
    public function destroy(Mark $mark): RedirectResponse
    {
        abort_if(!auth()->user()->can('delete_mark'), 403);
        $mark->delete();
        return redirect()->back();
    }
}
