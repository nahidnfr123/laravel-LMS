<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecordedClassRequest;
use App\Http\Requests\UpdateRecordedClassRequest;
use App\Models\RecordedClass;

class RecordedClassController extends Controller
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
     * @param  \App\Http\Requests\StoreRecordedClassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecordedClassRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RecordedClass  $recordedClass
     * @return \Illuminate\Http\Response
     */
    public function show(RecordedClass $recordedClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RecordedClass  $recordedClass
     * @return \Illuminate\Http\Response
     */
    public function edit(RecordedClass $recordedClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecordedClassRequest  $request
     * @param  \App\Models\RecordedClass  $recordedClass
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecordedClassRequest $request, RecordedClass $recordedClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecordedClass  $recordedClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecordedClass $recordedClass)
    {
        //
    }
}
