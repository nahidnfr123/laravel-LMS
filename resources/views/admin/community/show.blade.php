@extends('layouts.admin')

@section('head')

@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 font-weight-bold">{{ $communityPost->name }}</h3>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
                <a href="{{route('admin.community_post.edit', $communityPost->id)}}" class="btn btn-sm bg-white btn-icon-text border">
                    <i class="typcn typcn-pencil mr-2"></i>Edit
                </a>
            </div>
        </div>
    </div>
    <div class="row  mt-3">
        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <img src="{{$communityPost->photo}}" alt="" height="60" class="rounded-lg">
                    {!! $communityPost->description !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@stop
