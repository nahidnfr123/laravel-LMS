<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunityPostRequest;
use App\Http\Requests\UpdateCommunityPostRequest;
use App\Models\CommunityPost;

class CommunityPostController extends Controller
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
     * @param  \App\Http\Requests\StoreCommunityPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommunityPostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityPost  $communityPost
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityPost $communityPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityPost  $communityPost
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityPost $communityPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommunityPostRequest  $request
     * @param  \App\Models\CommunityPost  $communityPost
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommunityPostRequest $request, CommunityPost $communityPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityPost  $communityPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityPost $communityPost)
    {
        //
    }
}
