<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicAttendanceRequest;
use App\Http\Requests\UpdateTopicAttendanceRequest;
use App\Models\TopicAttendance;

class TopicAttendanceController extends Controller
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
     * @param  \App\Http\Requests\StoreTopicAttendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopicAttendanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TopicAttendance  $topicAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(TopicAttendance $topicAttendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TopicAttendance  $topicAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(TopicAttendance $topicAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTopicAttendanceRequest  $request
     * @param  \App\Models\TopicAttendance  $topicAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopicAttendanceRequest $request, TopicAttendance $topicAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TopicAttendance  $topicAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopicAttendance $topicAttendance)
    {
        //
    }
}
