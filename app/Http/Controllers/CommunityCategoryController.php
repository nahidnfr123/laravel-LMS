<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunityCategoryRequest;
use App\Http\Requests\UpdateCommunityCategoryRequest;
use App\Models\CommunityCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class CommunityCategoryController extends Controller
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
            $communityCategory = CommunityCategory::all();
            return view('admin.community.category.index', compact('communityCategory'));
        }

        $communityCategory = CommunityCategory::where('status', true)->get();
        return view('community.index', compact('communityCategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $communityCategory = new CommunityCategory();
        $action = URL::route('admin.community_category.store');
        return view('admin.community.category.form', compact('communityCategory', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommunityCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCommunityCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        unset($data['photo']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $this->photoUploader($request->file('photo'));
        }
        CommunityCategory::create($data);
        return redirect()->route('admin.community.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param CommunityCategory $communityCategory
     * @return Response
     */
    public function show(CommunityCategory $communityCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param CommunityCategory $communityCategory
     * @return Application|Factory|View
     */
    public function edit(CommunityCategory $communityCategory): View|Factory|Application
    {
        $action = URL::route('admin.community_category.update', $communityCategory->id);
        return view('admin.community.category.form', compact('communityCategory', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommunityCategoryRequest $request
     * @param CommunityCategory $communityCategory
     * @return RedirectResponse
     */
    public function update(UpdateCommunityCategoryRequest $request, CommunityCategory $communityCategory): RedirectResponse
    {
        $data = $request->validated();
        unset($data['photo']);
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/uploads/img');
            $data['photo'] = $path;
        }
        $communityCategory->update($data);
        return redirect()->route('admin.community.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommunityCategory $communityCategory
     * @return RedirectResponse
     */
    public function destroy(CommunityCategory $communityCategory): RedirectResponse
    {
        $communityCategory->delete();
        return redirect()->back();
    }
}
