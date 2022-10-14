<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunityPostRequest;
use App\Http\Requests\UpdateCommunityPostRequest;
use App\Models\CommunityPost;
use Illuminate\Http\Request;

class CommunityPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $prefix = $request->route()->getPrefix();
        if ($prefix === 'admin/') {
            $communityPost = CommunityPost::all();
            return view('admin.community.index', compact('communityPost'));
        }

        $communityPost = CommunityPost::where('is_published', true)->where('is_public', true)->get();
        return view('community.index', compact('communityPost'));
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
