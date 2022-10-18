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
                                @elseif($course->price)
                                    <p>Tk. <strong>{{$course->discounted_price ?? $course->price}}</strong></p>
                                @else
                                    <p><strong class="text-success">Free</strong></p>
                                @endif

                                @if($course->subscription_status)
                                    <p><strong class="text-success">Active</strong></p>
                                @else
                                    @if($course->discounted_price || $course->price)
                                        <button class="btn btn-primary btn-block" id="sslczPayBtn"
                                                token="if you have any token validation"
                                                postdata=""
                                                order="If you already have the transaction generated for current order"
                                                endpoint="{{ url('/pay-via-ajax') }}"> Pay Now
                                        </button>
                                    @else
                                        <a href="{{route('home.course.enroll', $course->id)}}" class="btn btn-primary">Enroll</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-2 card">
                        <div class="card-body">
                            <div class="course-rating d-flex" style="column-gap: 10px">
                                <div class="mr-2"><strong>{{$course->rating}}</strong></div>
                                <div class="mr-2">
                                    @for ($i = 0; $i < 5; ++$i)
                                        <i class="fa fa-star{{ $course->rating <= $i ? '-o' : ''}} '" aria-hidden="true"></i>
                                    @endfor
                                </div>
                                <div>( <strong class="mr-2">{{count($course->reviews)}}</strong> <i class="fa fa-users"></i> )</div>
                            </div>
                            <hr>
                            @if($course->subscription_status)
                                <div>
                                    <h4>Review</h4>
                                    @php
                                        $reviewable_id = $course->id;
                                        $reviewable_type = 'course';
                                    @endphp
                                    @include('components.ratingForm')
                                </div>
                            @endif
                        </div>
                    </div>

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
                                                <hr>
                                                <div>"{{$review->review}}"</div>

                                                @if(auth()->check() && $review->user_id === auth()->id())
                                                    <form action="{{route('home.review.destroy', $review->id)}}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn btn-xs btn-danger rounded-lg">Remove</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-body">
                            {{--                    {!! html_entity_decode($post->body) !!}--}}
                            @if($course->status_text === 'rejected')
                                <div class="alert alert-info">Previous Payment rejected</div>
                            @endif
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
                                                                @if(($content->paid && $course->subscription_status) || !$content->paid)
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
                                                                                    @if(auth()->check() && $course->subscription_status)
                                                                                        @php
                                                                                            $user =$content->assignment->users->find(auth()->id())
                                                                                        @endphp
                                                                                        @if(!empty($user) && $user->pivot->file)
                                                                                            <iframe src="{{$user->pivot->file}}" height="500" width="100%"></iframe>
                                                                                        @endif
                                                                                        @if(\Carbon\Carbon::now()->isBetween($content->assignment->start_time, $content->assignment->end_time))
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
                                                                                        @else
                                                                                            <p class="text-danger">Upload option is available only between your start and end time.</p>
                                                                                        @endif
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
                                                                                    @if(\Carbon\Carbon::now()->isBetween($content->exam->start_time, $content->exam->end_time))
                                                                                        <a href="{{route('home.exam.show', $content->exam->id)}}" target="_blank" disabled="disabled" class="btn btn-sm btn-primary">Start Exam</a>
                                                                                        {{--                                                                                    <a href="{{ $content->live_class->link }}" target="_blank" disabled="disabled" class="btn btn-sm btn-primary">Go To Link</a>--}}
                                                                                    @else
                                                                                        <p class="text-danger">Link will appear on time.</p>
                                                                                    @endif
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
                                                                                @if(\Carbon\Carbon::now()->isBetween($content->live_class->start_time, $content->live_class->end_time))
                                                                                    <a href="{{route('home.attendance.store', ['live_class_id'=>$content->live_class->id])}}" target="_blank" disabled="disabled" class="btn btn-sm btn-primary">Go To Link</a>
                                                                                    {{--                                                                                    <a href="{{ $content->live_class->link }}" target="_blank" disabled="disabled" class="btn btn-sm btn-primary">Go To Link</a>--}}
                                                                                @else
                                                                                    <p class="text-danger">Link will appear on time.</p>
                                                                                @endif
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
                                                                @endif
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

    <script>
        const obj = {};
        @if(auth()->check())
            obj.cus_name = '{!! auth()->user()->name?:null !!}';
        obj.cus_phone = $('#mobile').val();
        obj.cus_email = '{!! auth()->user()->email?:null !!}';
        obj.amount = '{!! $course->discounted_price ?? $course->price !!}'
        obj.user_id = '{!! auth()->id()?:0 !!}'
        obj.course_id = '{!! $course->id?:0 !!}'
        @endif

        $('#sslczPayBtn').prop('postdata', obj);

        (function (window, document) {
            const loader = function () {
                const script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>

@stop
