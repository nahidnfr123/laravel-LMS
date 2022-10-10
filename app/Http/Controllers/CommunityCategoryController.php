<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunityCategoryRequest;
use App\Http\Requests\UpdateCommunityCategoryRequest;
use App\Models\CommunityCategory;

class CommunityCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreCommunityCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommunityCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityCategory  $communityCategory
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityCategory $communityCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityCategory  $communityCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityCategory $communityCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommunityCategoryRequest  $request
     * @param  \App\Models\CommunityCategory  $communityCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommunityCategoryRequest $request, CommunityCategory $communityCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityCategory  $communityCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityCategory $communityCategory)
    {
        //
    }
}
