<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunityTagsRequest;
use App\Http\Requests\UpdateCommunityTagsRequest;
use App\Models\CommunityTags;

class CommunityTagsController extends Controller
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
     * @param  \App\Http\Requests\StoreCommunityTagsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommunityTagsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityTags  $communityTags
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityTags $communityTags)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityTags  $communityTags
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityTags $communityTags)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommunityTagsRequest  $request
     * @param  \App\Models\CommunityTags  $communityTags
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommunityTagsRequest $request, CommunityTags $communityTags)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityTags  $communityTags
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityTags $communityTags)
    {
        //
    }
}
