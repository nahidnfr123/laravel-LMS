@extends('layouts.home')

@section('head')
    <link rel="stylesheet" href="/compiled/flipclock.css">
@stop

@section('content')
    <div id="overviews" class="section wb">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <h2 class="mb-0 font-weight-bold">{{ $course->title }} : {{$content->title}}</h2>
                </div>
            </div>

            <div class="row  mt-3">
                <div class="col-12">
                    @if($content->exam)
                        <div>
                            <span>Duration: <strong>{{ $content->exam->duration }}</strong></span>,
                            <span>Per Question Mark: <strong>{!! $content->exam->per_question_mark !!}</strong></span>,
                            <span>Negative Mark: <strong>{!! $content->exam->negative_mark !!}</strong></span>,
                            <span>Total Marks: <strong>{!! count($content->exam->mcqs) * $content->exam->per_question_mark !!}</strong></span>,
                            <span>Pass Mark: <strong>{!! $content->exam->pass_mark !!}</strong></span>,
                            <div>
                                <div class="badge rounded-pill text-bg-primary">
                                    Start Time: <strong>{{ \Carbon\Carbon::parse($content->exam->start_time)  }}</strong>
                                </div>
                                <div class="badge rounded-pill text-bg-primary">
                                    End Time: <strong>{{ \Carbon\Carbon::parse($content->exam->end_time)  }}</strong>
                                </div>
                                <div class="badge rounded-pill text-bg-primary">
                                    Result Time: <strong>{{ \Carbon\Carbon::parse($content->exam->result_publish_time)  }}</strong>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-12">
                    @if($content->exam)
                        <div class="clock" style="margin:2em;"></div>
                        <div class="message"></div>

                        @if(count($content->exam->mcqs) > 0)
                            <div class="row bg-danger py-2">
                                <form action="{{route('home.exam.store')}}" method="POST">
                                    @if($result->start_time)
                                        <div class="badge bg-white text-black" style="font-size: 16px">
                                            Exam Started At: <strong class="ml-2">{{$result->start_time}}</strong>
                                        </div>
                                    @endif
                                    @if($result->end_time)
                                        <div class="badge bg-white text-black" style="font-size: 16px">
                                            Exam Ended At: <strong class="ml-2">{{$result->end_time}}</strong>
                                        </div>
                                    @endif
                                    @if($result->submitted)
                                        <div class="my-3 text-center" style="position: sticky">
                                            <div class="text-white">
                                                <div>Total Marks: {{$result->total_mark}}</div>
                                                <div>Obtained Marks: {{$result->obtained_mark}}</div>
                                                <div>Time Taken: {{$result->duration}}</div>
                                            </div>
                                            <a href="{{route('home.exam.ranking',$content->exam->id)}}" class="btn bg-white">
                                                Ranking
                                            </a>
                                        </div>
                                    @else
                                        <div class="my-3 text-center" style="position: sticky">
                                            <button type="submit" class="btn bg-white">Submit</button>
                                        </div>
                                    @endif
                                    <div class="py-2" style="position: relative; height: 80vh; overflow: auto">
                                        @csrf()
                                        @method('POST')
                                        <input type="hidden" name="exam_id" value="{{$content->exam->id}}">
                                        <input type="hidden" name="start_time" value="{{\Carbon\Carbon::now()}}">
                                        @foreach($content->exam->mcqs as  $key =>  $mcq)
                                            <div class="col-12 mb-1">
                                                <div class="card">
                                                    <div class="card-body">
                                                        @if(!$result->submitted)
                                                            <div>
                                                                {{$key+1}}. {!! $mcq->question !!}
                                                            </div>
                                                            <div class="form-group">
                                                                @foreach(['a', 'b', 'c', 'd', 'e'] as $option)
                                                                    <div class="form-check" style="border-radius: 10px; padding: 4px 0 4px 30px">
                                                                        <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input" name="mcq-{{$mcq->id}}" id="{{$mcq->id . $mcq[$option]}}" value="{{$option}}">
                                                                            {{$mcq[$option]}}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <div class="d-flex justify-content-between">
                                                                <div>
                                                                    {{$key+1}}. {!! $mcq->question !!}
                                                                </div>
                                                                <div>
                                                                    @php
                                                                        $user_answer=null;
                                                                        $correct = false;
                                                                        $wrong = false;
                                                                        $notAnswered = false;
                                                                    @endphp
                                                                    @if(count($mcq->users))
                                                                        @php
                                                                            $user_answer = $mcq->users()
                                                                            ->wherePivot('user_id', auth()->id())
                                                                            ->wherePivot('exam_id', $content->exam->id)
                                                                            ->first()
                                                                            ->pivot
                                                                            ->user_answer ?? null;
                                                                        @endphp
                                                                    @endif
                                                                    @php
                                                                        if($user_answer == null) $notAnswered = true;
                                                                        else if($user_answer !== $mcq->answer) $wrong = true;
                                                                        else $correct = true;
                                                                    @endphp

                                                                    <i class="fa @if($correct) fa-check text-success @elseif($wrong) fa-close text-danger @elseif($notAnswered) fa-question text-warning @else @endif"></i>
                                                                    {{$user_answer}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                @foreach(['a', 'b', 'c', 'd', 'e'] as $option)
                                                                    <div class="form-check
                                                                    @if(!$user_answer && $mcq->answer === $option) bg-warning text-white
                                                                    @elseif($user_answer === $option && $mcq->answer === $user_answer) bg-success text-white
                                                                    @elseif($user_answer === $option && $mcq->answer !== $user_answer) bg-danger text-white
                                                                    @elseif($mcq->answer === $option) bg-success text-white @endif" style="border-radius: 10px; padding: 4px 0 4px 30px">
                                                                        <label class="form-check-label pa-1 pl-2">
                                                                            <input type="radio" class="form-check-input" name="mcq-{{$mcq->id}}" id="{{$mcq->id . $mcq[$option]}}" value="{{$option}}"
                                                                                   @if($user_answer === $option) checked @else disabled @endif>
                                                                            {{$mcq[$option]}}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </form>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if(!$result->submitted && $result->start_time)
        <script src="/compiled/flipclock.js"></script>
        <script type="text/javascript">
            var clock;

            $(document).ready(function () {
                var clock;

                clock = $('.clock').FlipClock({
                    clockFace: 'DailyCounter',
                    autoStart: false,
                    callbacks: {
                        stop: function () {
                            $('.message').html('The clock has stopped!')
                        }
                    }
                });
                @php
                    $from = \Carbon\Carbon::parse($result->start_time);
                    $to = \Carbon\Carbon::parse($result->start_time)->addMinutes($content->exam->duration);
                    $diff_in_hours = $to->diffInSeconds($from);
                @endphp

                let start = '{{$diff_in_hours}}'
                console.log(start)
                clock.setTime(Number(start));
                clock.setCountdown(true);
                clock.start();
            });
        </script>
    @endif
@stop
