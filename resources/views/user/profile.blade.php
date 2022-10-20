@extends('layouts.home')

@section('head')
@stop

@section('content')
    <div id="overviews" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Profile</h2>
                    <hr>
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    @if(auth()->user()->avatar)
                                        <img src="{{auth()->user()->avatar}}" alt="" height="160" width="160">
                                    @else
                                        <img src="https://cdn.onlinewebfonts.com/svg/img_87237.png" alt="" height="160" width="160">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td>{{auth()->user()->name}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>{{auth()->user()->email}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Phone</th>
                                            <td>{{auth()->user()->phone}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Dob</th>
                                            <td>{{auth()->user()->dob}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Gender</th>
                                            <td>{{auth()->user()->gender}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Role</th>
                                            <td>{{auth()->user()->role}}</td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <a href="{{route('home.profile.edit')}}" class="btn btn-primary px-4">Edit</a>
                                    <a href="{{route('home.profile.passwordEdit')}}" class="btn btn-primary px-4">Update password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                </div>
                <div class="col-12">
                    <h2>My Courses</h2>
                    <hr>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@stop
