@extends('layouts.home')

@section('head')
@stop

@section('content')
    <div id="overviews" class="section wb">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <h2 class="mb-0 font-weight-bold">{{ $course->title }}</h2>
                </div>
            </div>

            <div class="row  mt-3">
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{$course->photo}}" alt="" class="img-fluid" style="height: 240px!important;">
                            <div class="my-2">

                                @if($course->discounted_price)
                                    <p>Tk.
                                        <span style="text-decoration: line-through;">
                                       {{ $course->price}}
                                    </span>
                                        <strong>{{$course->discounted_price}}</strong>
                                    </p>
                                @else
                                    <p>Tk. <strong>{{$course->discounted_price ?? $course->price}}</strong></p>
                                @endif

                                @if($course->subscription_status)
                                    <p><strong class="text-success">Active</strong></p>
                                @else
                                    <a href="{{route('home.course.enroll', $course->id)}}" class="btn btn-primary">Enroll</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
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
                                            </div>
                                            <div id="section-collapse{{$section->id}}" class="accordion-collapse collapse" aria-labelledby="content-heading{{$section->id}}">
                                                <div class="accordion-body">
                                                    @if(count($section->contents)>0)
                                                        <div class="accordion" id="accordion-panelExample">
                                                            @foreach($section->contents as $content)
                                                                <div class="accordion-item">
                                                                    <div class="accordion-header d-flex justify-between align-center" id="section-heading{{$content->id}}">
                                                                        <button class="accordion-button" @if($content->paid && !$course->subscription_status) disabled @endif type="button" data-bs-toggle="collapse" data-bs-target="#content-collapse{{$content->id}}" aria-expanded="true" aria-controls="content-collapse{{$content->id}}">
                                                                            @if($content->paid && !$course->subscription_status)
                                                                                <i class="fa fa-lock" style="color: red"></i>
                                                                            @else
                                                                                <i class="fa fa" style="color: green"></i>
                                                                            @endif
                                                                            <span style="color:@if($content->paid && !$course->subscription_status) #949393 @else black  @endif; margin-left: 20px">{{ ucfirst($content->type) }}: {{ $content->title }}</span>
                                                                        </button>
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

                                                                                @if($course->subscription_status)
                                                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                                        <i class="typcn typcn-file mr-2"></i> Upload Assignment
                                                                                    </button>

                                                                                    <!-- Modal -->
                                                                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Assignment</h1>
                                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                </div>
                                                                                                <form action="{{ route('home.assignment.upload', $content->assignment->id) }}" method="post" enctype="multipart/form-data">
                                                                                                    @csrf
                                                                                                    @method('POST')
                                                                                                    <div class="modal-body">
                                                                                                        <input type="hidden" class="form-control" name="assignment_id" value="{{$content->assignment->id}}">
                                                                                                        <input type="hidden" class="form-control" name="content_id" value="{{$content->id}}">
                                                                                                        <input type="file" class="form-control" name="file">
                                                                                                    </div>
                                                                                                    <div class="modal-footer">
                                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
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
                                                                            {{ $content->pdf }}
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
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
@endsection

@section('script')

@stop
