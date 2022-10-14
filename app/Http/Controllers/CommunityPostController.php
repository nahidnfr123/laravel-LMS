<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunityPostRequest;
use App\Http\Requests\UpdateCommunityPostRequest;
use App\Models\CommunityCategory;
use App\Models\CommunityPost;
use App\Models\CommunityTags;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class CommunityPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $prefix = $request->route()->getPrefix();
        if ($prefix === 'admin/') {
            $communityPosts = CommunityPost::all();
            return view('admin.community.index', compact('communityPosts'));
        }

        $communityPosts = CommunityPost::where('is_published', true)->where('is_public', true)->get();
        return view('community.index', compact('communityPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $communityPost = new CommunityPost();
        $communityCategories = CommunityCategory::all();
        $communityTags = CommunityTags::all();
        $action = URL::route('admin.community_post.store');
        return view('admin.community.form', compact('communityPost', 'action', 'communityCategories', 'communityTags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommunityPostRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCommunityPostRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $data = $request->validated();
        unset($data['photo'], $data['community_tag_ids']);
        $data['user_id'] = $user->id;
        if ($user && $user->role === 'admin') {
            $data['approved_by'] = $user->id;
        }
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->photoUploader($request->file('photo'));
        }
        $communityPost = CommunityPost::create($data);
        if ($request['community_tag_ids'] && count($request['community_tag_ids'])) {
            foreach ($request['community_tag_ids'] as $id) {
                $communityPost->communityTags()->attach($id);
            }
        }
        return redirect()->route('admin.community_post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param CommunityPost $communityPost
     * @return Application|Factory|View
     */
    public function show(CommunityPost $communityPost): View|Factory|Application
    {
        return view('admin.community.show', compact('communityPost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CommunityPost $communityPost
     * @return Application|Factory|View
     */
    public function edit(CommunityPost $communityPost): View|Factory|Application
    {
        $communityCategories = CommunityCategory::all();
        $communityTags = CommunityTags::all();
        $action = URL::route('admin.community_post.update', $communityPost->id);
        return view('admin.community.form', compact('communityPost', 'action', 'communityCategories', 'communityTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommunityPostRequest $request
     * @param CommunityPost $communityPost
     * @return RedirectResponse
     */
    public function update(UpdateCommunityPostRequest $request, CommunityPost $communityPost): RedirectResponse
    {
        $user = auth()->user();
        $data = $request->validated();
        unset($data['photo'], $data['community_tag_ids']);
        if (!$request->has('is_published')) {
            $data['is_published'] = false;
        }
        if (!$request->has('is_public')) {
            $data['is_public'] = false;
        }
        $data['user_id'] = $user->id;
        if ($user && $user->role === 'admin') {
            $data['approved_by'] = $user->id;
        }
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->photoUploader($request->file('photo'));
        }
        $communityPost->update($data);
        if ($request['community_tag_ids'] && count($request['community_tag_ids'])) {
            $communityPost->communityTags()->detach();
            foreach ($request['community_tag_ids'] as $id) {
                $communityPost->communityTags()->attach($id);
            }
        }
        return redirect()->route('admin.community_post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommunityPost $communityPost
     * @return RedirectResponse
     */
    public function destroy(CommunityPost $communityPost): RedirectResponse
    {
        $communityPost->delete();
        return redirect()->back();
    }
}
