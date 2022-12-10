@extends('layouts.admin')

@section('head')

@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 font-weight-bold">{{ $course->title }}</h3>
            <p class="mt-2">
                Status: <strong>{{ $course->status ? 'Active' : 'Inactive'}}</strong>,
                Featured: <strong>{{ $course->featured ? 'True' : 'False'}}</strong>
            </p>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
                @can('update_course')
                    <a href="{{route('admin.course.edit', $course->id)}}" class="btn btn-sm bg-white btn-icon-text border">
                        <i class="typcn typcn-pencil mr-2"></i>Edit
                    </a>
                @endcan
                <a href="{{route('admin.section.create', ['course'=>$course->id])}}" class="btn btn-sm bg-white btn-icon-text border">
                    <i class="typcn typcn-plus mr-2"></i>Add Section
                </a>
            </div>
        </div>
    </div>

    <div class="row  mt-3">
        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    {{--                    {!! html_entity_decode($post->body) !!}--}}
                    @if(count($course->sections)>0)
                        <div class="accordion" id="accordion-panelExample">
                            @foreach($course->sections as $section)
                                <div class="accordion-item">
                                    <div class="accordion-header d-flex justify-between align-center" id="section-heading{{$section->id}}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#section-collapse{{$section->id}}" aria-expanded="true" aria-controls="section-collapse{{$section->id}}">
                                            {{$section->title}}
                                        </button>

                                        <form action="{{ route('admin.section.destroy', $section->id) }}" class="d-flex  mt-2 ml-2" method="POST" style="width: 360px">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <div>
                                                <a href="{{route('admin.content.create', ['section'=>$section->id])}}" class="btn btn-xs btn-behance rounded-lg mr-1">
                                                    <i class="typcn typcn-plus mr-2"></i>Add Content
                                                </a>
                                            </div>
                                            <div>
                                                <a href="{{route('admin.section.edit', $section->id)}}" class="btn btn-xs btn-primary rounded-lg mr-1">
                                                    <i class="typcn typcn-pencil mr-2"></i>Edit
                                                </a>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-xs btn-danger rounded-lg">
                                                    <i class="typcn typcn-trash mr-2"></i>Delete
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="section-collapse{{$section->id}}" class="accordion-collapse collapse" aria-labelledby="content-heading{{$section->id}}">
                                        <div class="accordion-body">
                                            @if(count($section->contents)>0)
                                                <div class="accordion" id="accordion-panelExample">
                                                    @foreach($section->contents as $content)
                                                        <div class="accordion-item">
                                                            <div class="accordion-header d-flex justify-between align-center" id="section-heading{{$content->id}}">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#content-collapse{{$content->id}}" aria-expanded="true" aria-controls="content-collapse{{$content->id}}">
                                                                    {{ ucfirst($content->type) }}: {{ $content->title }}
                                                                </button>

                                                                <form action="{{ route('admin.content.destroy', $content->id) }}" class="d-flex mt-2 ml-2" method="POST" style="width: 400px">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <div>
                                                                        @if($content->exam)
                                                                            <a href="{{route('admin.exam.index', ['content_id'=> $content->id])}}" class="btn btn-xs btn-behance rounded-lg mr-1">
                                                                                Mcq
                                                                            </a> <a href="{{route('admin.exam.ranking', $content->exam->id)}}" class="btn btn-xs btn-dark rounded-lg mr-1">
                                                                                Ranking
                                                                            </a>
                                                                        @endif
                                                                        @if($content->assignment)
                                                                            <a href="{{route('admin.assignment.show', $content->assignment->id)}}" class="btn btn-xs btn-behance rounded-lg mr-1">
                                                                                Submissions
                                                                            </a>
                                                                        @endif
                                                                        @if($content->live_class)
                                                                            <a href="{{route('admin.live_class.show', $content->live_class->id)}}" class="btn btn-xs btn-behance rounded-lg mr-1">
                                                                                Attendance
                                                                            </a>
                                                                        @endif
                                                                        <a href="{{route('admin.content.edit', $content->id)}}" class="btn btn-xs btn-primary rounded-lg mr-1">
                                                                            <i class="typcn typcn-pencil mr-2"></i>Edit
                                                                        </a>
                                                                    </div>
                                                                    <div>
                                                                        <button type="submit" class="btn btn-xs btn-danger rounded-lg">
                                                                            <i class="typcn typcn-trash mr-2"></i>Delete
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div id="content-collapse{{$content->id}}" class="accordion-collapse collapse" aria-labelledby="content-heading{{$content->id}}">
                                                            <div class="accordion-body">
                                                                @if($content->assignment)
                                                                    <div>
                                                                        <h3>Question: </h3>
                                                                        {!!  $content->assignment->question !!}

                                                                        <div class="mt-1">
                                                                            <div class="badge rounded-pill text-bg-primary">
                                                                                Start Time: <strong>{{ \Carbon\Carbon::parse($content->assignment->start_time)  }}</strong>
                                                                            </div>
                                                                            <div class="badge rounded-pill text-bg-primary">
                                                                                End Time: <strong>{{ \Carbon\Carbon::parse($content->assignment->end_time)  }}</strong>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if($content->exam)
                                                                    <div>
                                                                        <div>Duration: {{ $content->exam->duration }}</div>
                                                                        <div>per_question_mark: {!! $content->exam->per_question_mark !!}</div>
                                                                        <div>negative_mark: {!! $content->exam->negative_mark !!}</div>
                                                                        <div>pass_mark: {!! $content->exam->pass_mark !!}</div>

                                                                        <div class="my-2">
                                                                            <div><strong>Details:</strong></div>
                                                                            {!!  $content->exam->description !!}
                                                                        </div>

                                                                        <div class="mt-1">
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
                                                                @if($content->recorded_class)
                                                                    <iframe
                                                                        width="560"
                                                                        height="315"
                                                                        src="{{ $content->recorded_class->link }}"
                                                                        title="YouTube video player"
                                                                        frameborder="0"
                                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                        allowfullscreen></iframe>
                                                                @endif
                                                                @if($content->live_class)
                                                                    <a href="{{ $content->live_class->link }}" target="_blank" class="btn btn-sm btn-primary">Go To Link</a>
                                                                    <div class="mt-1">
                                                                        <div class="badge rounded-pill text-bg-primary">
                                                                            Start Time: <strong>{{ \Carbon\Carbon::parse($content->live_class->start_time)  }}</strong>
                                                                        </div>
                                                                        <div class="badge rounded-pill text-bg-primary">
                                                                            End Time: <strong>{{ \Carbon\Carbon::parse($content->live_class->end_time)  }}</strong>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if($content->note)
                                                                    {!! $content->note->note !!}
                                                                @endif
                                                                @if($content->pdf)
                                                                    @if($content->pdf->link)
                                                                        <iframe src="{{$content->pdf->link}}" height="500" width="100%"></iframe>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 d-flex grid-margin stretch-card">
            @if(count($course->reviews))
                <div class="mt-2 card">
                    <div class="card-body">
                        @foreach($course->reviews as $review)
                            <div class="mt-2 card">
                                <div class="card-body d-flex" style="column-gap: 10px; align-items: center">
                                    <div>
                                        @if($review->user->photo)
                                            <img src="{{$review->user->photo}}" alt="" height="60" class="rounded-lg">
                                        @else
                                            <img src="/images/profile.png" alt="" height="60" class="rounded-lg">
                                        @endif
                                        <div class=""><small>{{$review->user->name}}</small></div>
                                    </div>
                                    <div style="min-height: 100%; height: 100px; width: 2px; background-color: #0b2e1360;"></div>
                                    <div>
                                        <div>
                                            <strong class="mr-2">{{$review->rating}}</strong>
                                            <strong>
                                                @for ($i = 0; $i < 5; ++$i)
                                                    <i class="fa fa-star{{ $review->rating <= $i ? '-o' : ''}} '" aria-hidden="true"></i>
                                                @endfor
                                            </strong>
                                        </div>
                                        <div>"{{$review->review}}"</div>

                                        <div class="mt-2">
                                            @if(auth()->check())
                                                <form action="{{route('home.review.destroy', $review->id)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-xs btn-danger rounded-lg">Remove</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')

@stop
