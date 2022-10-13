<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLiveClassRequest;
use App\Http\Requests\UpdateLiveClassRequest;
use App\Models\Course;
use App\Models\LiveClass;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class LiveClassController extends Controller
{
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
     * @param \App\Http\Requests\StoreLiveClassRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLiveClassRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param LiveClass $liveClass
     * @return Application|Factory|View
     */
    public function show(LiveClass $liveClass): View|Factory|Application
    {
        $content = $liveClass->content;
        $attendedUsers = $liveClass->attendance;
        $enrolledUsers = Course::findOrFail($liveClass->content->section->course->id);

        $allAttendedUsers = [];
        if (count($enrolledUsers->users)) {
            foreach ($enrolledUsers->users as $user) {
                $allAttendedUsers[] = ['user_id' => $user->id, 'attended' => (bool)$liveClass->attendance->where('id', '=', $user->id)->first()];
            }
        }
        dd($enrolledUsers->users, $allAttendedUsers);
        return view('admin.course.content.live_class.index', compact('allAttendedUsers', 'content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param LiveClass $liveClass
     * @return \Illuminate\Http\Response
     */
    public function edit(LiveClass $liveClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateLiveClassRequest $request
     * @param LiveClass $liveClass
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLiveClassRequest $request, LiveClass $liveClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LiveClass $liveClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiveClass $liveClass)
    {
        //
    }
}
