<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunityTagsRequest;
use App\Http\Requests\UpdateCommunityTagsRequest;
use App\Models\CommunityTags;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class CommunityTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $prefix = $request->route()->getPrefix();
        if ($prefix === 'admin/') {
            $communityTags = CommunityTags::all();
            return view('admin.community.tags.index', compact('communityTags'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        $communityTags = new CommunityTags();
        $action = URL::route('admin.community_tags.store');
        return view('admin.community.tags.form', compact('communityTags', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommunityTagsRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCommunityTagsRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['photo']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->photoUploader($request->file('photo'));
        }
        CommunityTags::create($data);
        return redirect()->route('admin.community_tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param CommunityTags $communityTags
     * @return Application|Factory|View
     */
    public function show(CommunityTags $communityTags): View|Factory|Application
    {
        return view('admin.community.tags.show', compact('communityTags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CommunityTags $communityTags
     * @return Application|Factory|View
     */
    public function edit($id): View|Factory|Application
    {
        $communityTags = CommunityTags::findOrFail($id);
        $action = URL::route('admin.community_tags.update', $communityTags->id);
        return view('admin.community.tags.form', compact('communityTags', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommunityTagsRequest $request
     * @param CommunityTags $communityTags
     * @return RedirectResponse
     */
    public function update(UpdateCommunityTagsRequest $request, $id): RedirectResponse
    {
        $communityTags = CommunityTags::findOrFail($id);
        $data = $request->validated();
        unset($data['photo']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->photoUploader($request->file('photo'));
        }
        $communityTags->update($data);
        return redirect()->route('admin.community_tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommunityTags $communityTags
     * @return RedirectResponse
     */
    public function destroy(CommunityTags $communityTags): RedirectResponse
    {
        $communityTags->delete();
        return redirect()->back();
    }
}
