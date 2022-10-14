@extends('layouts.admin')

@section('head')
@stop

@section('content')
    <div class="row  mt-3">
        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1>
                        @if ($section->created_at)
                            Edit Section
                        @else
                            Add Section
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
                        @if ($section->created_at)
                            @method('PUT')
                        @else
                            @method('POST')
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6 form-group" style="visibility: hidden; position: absolute; opacity: 0">
                                <label for="course_id"></label>
                                <input
                                    type="text"
                                    class="form-control @error('course_id') is-invalid @enderror"
                                    id="course_id"
                                    name="course_id"
                                    placeholder="course_id"
                                    value="{{old('course_id', $section->course_id) ?? request()->get('course')}}"
                                    hidden
                                >
                            </div>
                            <div class="col-12 col-sm-6 form-group">
                                <label for="title">title</label>
                                <input
                                    type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    name="title"
                                    placeholder="title"
                                    value="{{old('title', $section->title)}}"
                                >
                            </div>
                            <div class="col-12 col-sm-6 mt-4">
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            @if (old('status', $section->status)) checked @endif
                                            name="status"
                                            value="1">
                                        status
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@stop
