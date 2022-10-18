@extends('layouts.home')

@section('head')
@stop

@section('content')
    <div id="overviews" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <h1>{{$communityPost->title}}</h1>
                    <hr>
                    <div class="mt-1">
                        {!! $communityPost->description !!}
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <img src="{{$communityPost->photo}}" alt="" class="img-fluid">
                    <div class="mt-2 d-flex justify-content-between align-center">
                        <div>
                            <img src="{{$communityPost->user->photo ?? 'https://cdn3.iconfinder.com/data/icons/vector-icons-6/96/256-1024.png'}}" alt="" height="60px" width="60px">
                            <strong>{!! $communityPost->user->name !!}</strong>
                        </div>
                        <div class="mt-3">Published at: <strong>{{$communityPost->publish_at}}</strong></div>
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->
@endsection

@section('script')

@stop
