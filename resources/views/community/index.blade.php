@extends('layouts.home')

@section('head')
@stop

@section('content')

    <div class="all-title-box">
        <div class="container text-center">
            <h1>Join Our Community</h1>
        </div>
    </div>

    <div id="overviews" class="section wb">
        <div class="container">

            <div class="row">
                @if(auth()->check())
                    <div class="col-12 mb-2">
                        <a href="{{route('community_post.create')}}" class="btn btn-primary">Post on Community</a>
                    </div>
                @endif
                @foreach($communityPosts as $post)
                    <div class="col-lg-6 col-md-8 col-12 mb-4">
                        <div class="course-item">

                            <div class="course-br">
                                <div class="d-flex" style="column-gap: 20px">
                                    <img src="{{$post->user->photo ?? 'https://cdn3.iconfinder.com/data/icons/vector-icons-6/96/256-1024.png'}}" alt="" height="60px" width="60px">
                                    <div>
                                        <div>
                                            <strong>{!! $post->user->name !!}</strong>
                                        </div>
                                        @if(auth()->check() && $post->user->id === auth()->id())
                                            <form action="{{ route('community_post.destroy', $post->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <a href="{{route('community_post.edit', $post->id)}}" class="btn btn-sm btn-warning rounded">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <button type="submit" class="btn btn-xs btn-danger rounded-lg"><i class="fa fa-trash"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <div><h2>{{ $post->title }}</h2></div>
                                <div class="image-blog">
                                    <img src="{{$post->photo}}" alt="" class="img-fluid" style="max-height: 300px">
                                </div>
                                <div class="mt-2 d-flex justify-content-between align-center">
                                    <div>Published at: <strong>{{$post->publish_at}}</strong></div>

                                    <a href="{{route('community_post.show', $post->id)}}" class="btn btn-sm btn-warning">Read more</a>
                                </div>
                                <div class="mt-1" style="max-height: 200px; overflow: hidden">
                                    {!! $post->description !!}
                                </div>
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
