@extends('layouts.home')

@section('head')

@stop

@section('content')
    <div id="carouselExampleControls" class="carousel slide bs-slider box-slider" data-ride="carousel" data-pause="hover" data-interval="false">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleControls" data-slide-to="1"></li>
            <li data-target="#carouselExampleControls" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div id="home" class="first-section" style="background-image:url('/home/images/slider-01.jpg');">
                    <div class="dtab">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-right">
                                    <div class="big-tagline">
                                        <h2>{{ env('APP_NAME', 'ASAP') }}</h2>
                                        {{--                                        <p class="lead">With Landigoo responsive landing page template, you can promote your all hosting, domain and email services. </p>--}}
                                        <a href="/contact-us/create" class="hover-btn-new"><span>Contact Us</span></a>
                                    </div>
                                </div>
                            </div><!-- end row -->
                        </div><!-- end container -->
                    </div>
                </div><!-- end section -->
            </div>
            <div class="carousel-item">
                <div id="home" class="first-section" style="background-image:url('/home/images/slider-02.jpg');">
                    <div class="dtab">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-left">
                                    <div class="big-tagline">
                                        <h2 data-animation="animated zoomInRight">SmartEDU <strong>education school</strong></h2>
                                        <p class="lead" data-animation="animated fadeInLeft">With Landigoo responsive landing page template, you can promote your all hosting, domain and email services. </p>
                                        <a href="/#" class="hover-btn-new"><span>Contact Us</span></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="/#" class="hover-btn-new"><span>Read More</span></a>
                                    </div>
                                </div>
                            </div><!-- end row -->
                        </div><!-- end container -->
                    </div>
                </div><!-- end section -->
            </div>
            <div class="carousel-item">
                <div id="home" class="first-section" style="background-image:url('/home/images/slider-03.jpg');">
                    <div class="dtab">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                    <div class="big-tagline">
                                        <h2 data-animation="animated zoomInRight"><strong>VPS Servers</strong> Company</h2>
                                        <p class="lead" data-animation="animated fadeInLeft">1 IP included with each server
                                            Your Choice of any OS (CentOS, Windows, Debian, Fedora)
                                            FREE Reboots</p>
                                        <a href="#" class="hover-btn-new"><span>Contact Us</span></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="#" class="hover-btn-new"><span>Read More</span></a>
                                    </div>
                                </div>
                            </div><!-- end row -->
                        </div><!-- end container -->
                    </div>
                </div><!-- end section -->
            </div>
            <!-- Left Control -->
            <a class="new-effect carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="fa fa-angle-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <!-- Right Control -->
            <a class="new-effect carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="fa fa-angle-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>


    <div class="section cl">
        <div class="container">
            <div class="row text-left stat-wrap">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <span data-scroll class="global-radius icon_wrap effect-1 alignleft"><i class="flaticon-study"></i></span>
                    <p class="stat_count">{{count($users)}}</p>
                    <h3>Students</h3>
                </div><!-- end col -->

                <div class="col-md-4 col-sm-4 col-xs-12">
                    <span data-scroll class="global-radius icon_wrap effect-1 alignleft"><i class="flaticon-online"></i></span>
                    <p class="stat_count">{{count($courses)}}</p>
                    <h3>Courses</h3>
                </div><!-- end col -->

                <div class="col-md-4 col-sm-4 col-xs-12">
                    <span data-scroll class="global-radius icon_wrap effect-1 alignleft">{{--<i class="flaticon-years"></i>--}}</span>
                    <p class="">{{--55--}}</p>
                    <h3>{{--Years Completed--}}</h3>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

    <div id="plan" class="section lb">
        <div class="container">
            <div class="section-title text-center">
                <h3>Choose Your Plan</h3>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-12">
                    <div class="tab-content">
                        <div class="tab-pane active fade show" id="tab1">

                            <div class="row">
                                @if(count($courses))
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
                                @else
                                    <div class="my-2 alert alert-info">No content found</div>
                                @endif
                            </div><!-- end row -->
                        </div><!-- end pane -->
                    </div><!-- end content -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->
@endsection

@section('script')

@stop
