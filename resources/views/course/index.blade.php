@extends('layouts.home')

@section('head')
@stop

@section('content')

    <div class="all-title-box">
        <div class="container text-center">
            <h1>Courses<span class="m_1">Choose courses you might like.</span></h1>
        </div>
    </div>

    <div id="overviews" class="section wb">
        <div class="container">

            <div class="row">
                @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="course-item">
                            <div class="image-blog">
                                <img src="{{$course->photo}}" alt="" class="img-fluid" style="height: 240px!important;">
                            </div>
                            <div class="course-br">
                                <div class="course-title">
                                    <h2><a href="{{ route('home.course', $course->id) }}" title="">{{$course->title}}</a></h2>
                                </div>
                                <div class="course-desc">
                                    <p></p>
                                </div>
                                <div class="course-rating">
                                    <strong class="mr-2">{{$course->rating}}</strong>
                                    <strong>
                                        @for ($i = 0; $i < 5; ++$i)
                                            <i class="fa fa-star{{ $course->rating <= $i ? '-o' : ''}} '" aria-hidden="true"></i>
                                        @endfor
                                    </strong>
                                </div>

                                @if(auth()->check() && $course->subscription_status)
                                    <p class="text-success">
                                        <strong>{{$course->subscription_status ? 'Active' : ''}}</strong>
                                    </p>
                                @else
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
                                @endif
                            </div>
                            <div class="course-meta-bot">
                                <ul>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> 6 Month</li>
                                    <li><i class="fa fa-users" aria-hidden="true"></i> {{ count($course->users) }} Student</li>
                                    <li><i class="fa fa-book" aria-hidden="true"></i> 7 Books</li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- end col -->
                @endforeach
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->
@endsection

@section('script')

@stop
