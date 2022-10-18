@extends('layouts.home')

@section('head')
@stop

@section('content')
    <div id="overviews" class="section wb">
        <div class="container">
            <div class="row  mt-3">
                <div class="col-12 d-flex grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h1>
                                @if ($communityPost->created_at)
                                    Edit Community Post
                                @else
                                    Add Community Post
                                @endif
                            </h1>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="forms-sample" action="{{ $action }}" method="POST" enctype="multipart/form-data">
                                @if ($communityPost->created_at)
                                    @method('PUT')
                                @else
                                    @method('POST')
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-6 mt-4 form-group">
                                        <label for="title">title</label>
                                        <input
                                            type="text"
                                            class="form-control @error('title') is-invalid @enderror"
                                            id="title"
                                            name="title"
                                            placeholder="title"
                                            value="{{old('title', $communityPost->title)}}"
                                        >
                                    </div>
                                    <div class="col-12 col-sm-6 mt-4 form-group">
                                        <label for="photo">photo</label>
                                        <input
                                            type="file"
                                            class="form-control @error('photo') is-invalid @enderror"
                                            id="photo"
                                            name="photo"
                                            placeholder="photo"
                                        >
                                    </div>
                                    <div class="col- mt-4 form-group">
                                        <label for="editor">description</label>
                                        <textarea
                                            class="form-control @error('description') is-invalid @enderror"
                                            id="editor"
                                            placeholder="Enter the Description"
                                            name="description"
                                            style="min-height: 200px"
                                        >{{old('description', $communityPost->description)}}</textarea>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-4 form-group">
                                        <label for="publish_at">publish_at</label>
                                        <input
                                            type="datetime-local"
                                            class="form-control @error('publish_at') is-invalid @enderror"
                                            id="publish_at"
                                            name="publish_at"
                                            placeholder="publish_at"
                                            value="{{old('publish_at', $communityPost->publish_at)}}"
                                        >
                                    </div>
                                    <div class="col-12 col-sm-6 mt-4 form-group">
                                        <label for="Category">Category</label>
                                        <select class="form-select" id="Category" aria-label="multiple select example" name="community_category_id">
                                            <option selected></option>
                                            @foreach($communityCategories as $communityCategory)
                                                <option
                                                    value="{{$communityCategory->id}}"
                                                    @if(old('community_category_id', $communityPost->community_category_id)) selected @endif
                                                >
                                                    {{$communityCategory->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-4">
                                        <label for="tags">Tags</label>
                                        <select class="form-select" id="tags" multiple aria-label="multiple select example" name="community_tag_ids[]">
                                            @foreach($communityTags as $communityTag)
                                                <option
                                                    value="{{$communityTag->id}}"
                                                    {{is_array($communityPost->communityTags->pluck('id')->toArray()) && in_array($communityTag->id, $communityPost->communityTags->pluck('id')->toArray(), false) ? 'selected' : '' }}
                                                >
                                                    {{$communityTag->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2 mr-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@stop
