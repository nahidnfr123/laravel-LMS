<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Content;
use App\Models\Exam;
use App\Models\Result;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $content = Content::findOrFail($request->content_id);
        return view('admin.course.content.exam.index', compact('content'));
    }

    public function ranking(Request $request, $id): View|Factory|Application
    {
        $content = Exam::findOrFail($id);
        $content = $content->content;
        $results = Result::where('exam_id', $id)
            ->orderBy('obtained_mark', 'ASC')
            ->orderBy('duration', 'ASC')
            ->orderBy('created_at', 'ASC')
            ->get();
//        $content = Content::findOrFail($ranking->exam->content->id);
        return view('course.exam.ranking', compact('results', 'content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function create(Request $request): View|Factory|Application
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExamRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreExamRequest $request): \Illuminate\Http\RedirectResponse
    {
        $exam_id = $request->exam_id;
        $exam = Exam::findOrFail($exam_id);
        if (count($exam->mcqs)) {
            $correct = 0;
            $wrong = 0;
            $total = $exam->mcqs()->count();
            foreach ($exam->mcqs as $mcq) {
                if ($request->has('mcq-' . $mcq->id)) {
                    DB::table('mcq_user')->updateOrInsert([
                        'mcq_id' => $mcq->id,
                        'user_id' => auth()->id(),
                        'exam_id' => $request->exam_id,
                    ], [
                        'correct_answer' => $mcq->answer,
                        'user_answer' => $request['mcq-' . $mcq->id]
                    ]);
                }
                if ($request['mcq-' . $mcq->id] === $mcq->answer) {
                    $correct++;
                } else {
                    $wrong++;
                }
            }

            $start_time = Carbon::parse($request->start_time);
            $end_time = Carbon::parse(Carbon::now());
            $duration = $start_time->diffInMinutes($end_time);
            $result = Result::updateOrCreate([
                'exam_id' => $exam->id,
                'user_id' => auth()->id(),
            ], [
                'total_mark' => $total * $exam->per_question_mark,
                'correct' => $correct,
                'wrong' => $wrong,
                'obtained_mark' => $correct * $exam->per_question_mark,
                'end_time' => $end_time,
                'duration' => $duration,
                'submitted' => true,
                'status' => 'ended',
            ]);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Exam $exam
     * @return Application|Factory|View|RedirectResponse
     */
    public function show(Exam $exam): View|Factory|RedirectResponse|Application
    {
        if ($exam->content->section->course->subscription_status) {
            $course = $exam->content->section->course;
            $content = $exam->content;
            $result = Result::firstOrCreate([
                'exam_id' => $exam->id,
                'user_id' => auth()->id(),
            ], [
                'start_time' => Carbon::now(),
                'submitted' => false,
                'status' => 'started',
            ]);
            if (!$result->submitted) {
                $from = \Carbon\Carbon::parse($result->start_time);
                $to = \Carbon\Carbon::parse($result->start_time)->addMinutes($content->exam->duration);
                $diff_in_hours = $to->diffInSeconds($from);
                if (Carbon::now() > $to) {
                    $result->submitted = true;
                    $result->status = 'absent';
                    $result->save();
                }
            }
//            $result = $content->exam->results->where('user_id', auth()->id())->first();
            return view('course.exam.index', compact('course', 'content', 'result'));
        }
        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Exam $exam
     * @return Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateExamRequest $request
     * @param Exam $exam
     * @return Response
     */
    public function update(UpdateExamRequest $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Exam $exam
     * @return Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
