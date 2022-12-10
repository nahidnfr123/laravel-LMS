@extends('layouts.admin')

@section('content')
    <div class="row  mt-3">
        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1>
                        @if ($semester->created_at)
                            Edit Semester
                        @else
                            Add Semester to {{$subject->short_title}}
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
                    @can('create_semester', 'update_semester')
                        <form class="forms-sample" action="{{ $action }}" method="POST" enctype="multipart/form-data">
                            @if ($semester->created_at)
                                @method('PUT')
                            @else
                                @method('POST')
                            @endif
                            @csrf
                            <div class="row">
                                <input type="hidden" value="{{$subject->id}}" name="subject_id">
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="title">title</label>
                                    <input
                                        type="text"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="title"
                                        name="title"
                                        placeholder="title"
                                        value="{{old('title', $semester->title)}}"
                                    >
                                </div>

                                <div class="col-12 col-sm-6 form-group">
                                    <label for="short_title">short_title</label>
                                    <input
                                        type="text"
                                        class="form-control @error('short_title') is-invalid @enderror"
                                        id="short_title"
                                        name="short_title"
                                        placeholder="short_title"
                                        value="{{old('short_title', $semester->short_title)}}"
                                    >
                                </div>
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="duration">duration</label>
                                    <input
                                        type="number"
                                        class="form-control @error('duration') is-invalid @enderror"
                                        id="duration"
                                        name="duration"
                                        placeholder="duration"
                                        value="{{old('duration', $semester->duration)}}"
                                    >
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
