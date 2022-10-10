<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMcqRequest;
use App\Http\Requests\UpdateMcqRequest;
use App\Imports\MCQImport;
use App\Imports\McqsImport;
use App\Models\Content;
use App\Models\Exam;
use App\Models\Mcq;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;

class McqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function create(Request $request): View|Factory|Application
    {
        $content = Content::findOrFail($request->content_id);
        $mcq = new Mcq();
        $action = URL::route('admin.mcq.store');
        return view('admin.course.content.exam.mcq_from', compact('content', 'mcq', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMcqRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMcqRequest $request): RedirectResponse
    {
        $mcq = Mcq::create($request->validated());
        return redirect()->route('admin.exam.index', ['content_id' => $mcq->exam->content->id]);
    }

    public function import(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'content_id' => 'required',
            'exam_id' => 'required',
            'file' => 'required|file|mimes:ods,xls,xlsx',
        ]);
        $file = $request->file;
        if ($file->extension() === 'ods') {
            (new McqsImport($request->exam_id))->import($file, null, \Maatwebsite\Excel\Excel::ODS);
        } else {
            (new McqsImport($request->exam_id))->import($file, null, \Maatwebsite\Excel\Excel::XLSX);
        }
        return redirect()->route('admin.exam.index', ['content_id' => $request->content_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param Mcq $mcq
     * @return Response
     */
    public function show(Mcq $mcq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Mcq $mcq
     * @return Application|Factory|View
     */
    public function edit(Request $request, Mcq $mcq): View|Factory|Application
    {
        $content = Content::findOrFail($request->content_id);
        $action = URL::route('admin.mcq.update', $mcq->id);
        return view('admin.course.content.exam.mcq_from', compact('content', 'mcq', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMcqRequest $request
     * @param Mcq $mcq
     * @return RedirectResponse
     */
    public function update(UpdateMcqRequest $request, Mcq $mcq): RedirectResponse
    {
        $mcq->update($request->validated());
        return redirect()->route('admin.exam.index', ['content_id' => $mcq->exam->content->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Mcq $mcq
     * @return RedirectResponse
     */
    public function destroy(Mcq $mcq): RedirectResponse
    {
        $mcq->delete();
        return redirect()->back();
    }
}
