<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Models\Assignment;
use App\Models\Content;
use App\Models\Exam;
use App\Models\LiveClass;
use App\Models\Note;
use App\Models\Pdf;
use App\Models\RecordedClass;
use App\Models\Section;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class ContentController extends Controller
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
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $content = new Content();
        $action = URL::route('admin.content.store');
        return view('admin.course.content.form', compact('content', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreContentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreContentRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            if (!$request->has('paid')) {
                $request['paid'] = 0;
            }
            if (!$request->has('status')) {
                $request['status'] = 0;
            }
            $data = $request->only('section_id', 'title', 'available_at', 'type', 'paid', 'status');
            $content = Content::create($data);
            $request['content_id'] = $content->id;

            if ($content->type === 'assignment') {
                Assignment::create($request->only('content_id', 'question', 'total_mark', 'start_time', 'end_time'));
            } else if ($content->type === 'exam') {
                Exam::create($request->only('content_id', 'duration', 'description', 'per_question_mark', 'negative_mark', 'pass_mark', 'start_time', 'end_time', 'result_publish_time'));
            } else if ($content->type === 'recorded_class') {
                RecordedClass::create($request->only('content_id', 'link'));
            } else if ($content->type === 'live_class') {
                LiveClass::create($request->only('content_id', 'link', 'start_time', 'end_time'));
            } else if ($content->type === 'note') {
                Note::create($request->only('content_id', 'note'));
            } else if ($content->type === 'pdf') {
                if ($request->hasFile('file')) {
                    $file = $request->file;
                    $path = $file->store('public/uploads/assignments');
                    $fileUploaded = str_replace('public', '/storage', $path) ?? $path;
                    $request['link'] = $fileUploaded;
                }
                Pdf::create($request->only('content_id', 'link'));
            }
            DB::commit();
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex);
            return redirect()->back()->withInput(['error' => $ex], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Content $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Content $content
     * @return Application|Factory|View
     */
    public function edit(Content $content): View|Factory|Application
    {
        $action = URL::route('admin.content.update', $content->id);
        return view('admin.course.content.form', compact('content', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateContentRequest $request
     * @param Content $content
     * @return RedirectResponse
     */
    public function update(UpdateContentRequest $request, Content $content): RedirectResponse
    {
        DB::beginTransaction();
        try {
            if (!$request->has('paid')) {
                $request['paid'] = 0;
            }
            if (!$request->has('status')) {
                $request['status'] = 0;
            }
            $data = $request->only('section_id', 'title', 'available_at', 'type', 'paid', 'status');
            $content->update($data);
            $request['content_id'] = $content->id;

            if ($content->type === 'assignment') {
                $content->assignment()->update($request->only('content_id', 'question', 'total_mark', 'start_time', 'end_time'));
            } else if ($content->type === 'exam') {
                $content->exam()->update($request->only('content_id', 'duration', 'description', 'per_question_mark', 'negative_mark', 'pass_mark', 'start_time', 'end_time', 'result_publish_time'));
            } else if ($content->type === 'recorded_class') {
                $content->recorded_class()->update($request->only('content_id', 'link'));
            } else if ($content->type === 'live_class') {
                $content->live_class()->update($request->only('content_id', 'link', 'start_time', 'end_time'));
            } else if ($content->type === 'note') {
                $content->note()->update($request->only('content_id', 'note'));
            } else if ($content->type === 'pdf') {
                if ($request->hasFile('file')) {
                    $file = $request->file;
                    $path = $file->store('public/uploads/assignments');
                    $fileUploaded = str_replace('public', '/storage', $path) ?? $path;
                    $request['link'] = $fileUploaded;
                }
                $content->pdf()->update($request->only('content_id', 'link'));
            }
            DB::commit();
            return redirect()->back();
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex);
            return redirect()->back()->withInput(['error' => $ex], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Content $content
     * @return RedirectResponse
     */
    public function destroy(Content $content): RedirectResponse
    {
        $content->delete();
        return redirect()->back();
    }
}
