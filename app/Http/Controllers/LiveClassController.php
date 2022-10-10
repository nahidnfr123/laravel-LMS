<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLiveClassRequest;
use App\Http\Requests\UpdateLiveClassRequest;
use App\Models\LiveClass;

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
     * @param  \App\Http\Requests\StoreLiveClassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLiveClassRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LiveClass  $liveClass
     * @return \Illuminate\Http\Response
     */
    public function show(LiveClass $liveClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LiveClass  $liveClass
     * @return \Illuminate\Http\Response
     */
    public function edit(LiveClass $liveClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLiveClassRequest  $request
     * @param  \App\Models\LiveClass  $liveClass
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLiveClassRequest $request, LiveClass $liveClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LiveClass  $liveClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(LiveClass $liveClass)
    {
        //
    }
}
