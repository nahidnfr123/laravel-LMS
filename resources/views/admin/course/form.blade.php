@extends('layouts.admin')

@section('head')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
@stop

@section('content')
    <div class="row  mt-3">
        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1>
                        @if ($course->created_at)
                            Edit Course
                        @else
                            Add Course
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
                    @can('create_course', 'update_course')
                        <form class="forms-sample" action="{{ $action }}" method="POST" enctype="multipart/form-data">
                            @if ($course->created_at)
                                @method('PUT')
                            @else
                                @method('POST')
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="title">title</label>
                                    <input
                                        type="text"
                                        class="form-control @error('title') is-invalid @enderror"
                                        id="title"
                                        name="title"
                                        placeholder="title"
                                        value="{{old('title', $course->title)}}"
                                    >
                                </div>
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="subtitle">subtitle</label>
                                    <input
                                        type="text"
                                        class="form-control @error('subtitle') is-invalid @enderror"
                                        id="subtitle"
                                        name="subtitle"
                                        placeholder="subtitle"
                                        value="{{old('subtitle', $course->subtitle)}}"
                                    >
                                </div>
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="photo">photo</label>
                                    <input
                                        type="file"
                                        class="form-control @error('photo') is-invalid @enderror"
                                        id="photo"
                                        name="photo"
                                        placeholder="photo"
                                    >
                                </div>
                                <div class="col-12 form-group">
                                    <label for="editor">description</label>
                                    <textarea
                                        class="form-control @error('description') is-invalid @enderror"
                                        id="editor"
                                        placeholder="Enter the Description"
                                        name="description"
                                        style="min-height: 200px"
                                    >{{old('description', $course->description)}}</textarea>
                                </div>
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="price">price</label>
                                    <input
                                        type="number"
                                        class="form-control @error('price') is-invalid @enderror"
                                        id="price"
                                        name="price"
                                        placeholder="price"
                                        value="{{old('price', $course->price)}}"
                                    >
                                </div>
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="discounted_price">discounted_price</label>
                                    <input
                                        type="number"
                                        class="form-control @error('discounted_price') is-invalid @enderror"
                                        id="discounted_price"
                                        name="discounted_price"
                                        placeholder="discounted_price"
                                        value="{{old('discounted_price', $course->discounted_price)}}"
                                    >
                                </div>
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="available_at">available_at</label>
                                    <input
                                        type="datetime-local"
                                        class="form-control @error('available_at') is-invalid @enderror"
                                        id="available_at"
                                        name="available_at"
                                        placeholder="available_at"
                                        value="{{old('available_at', $course->available_at)}}"
                                    >
                                </div>
                                <div class="col-12 col-sm-6 mt-4">
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                @if (old('featured', $course->featured)) checked @endif
                                                name="featured"
                                                value="1">
                                            featured
                                        </label>
                                    </div>
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                @if (old('status', $course->status)) checked @endif
                                                name="status"
                                                value="1">
                                            status
                                        </label>
                                    </div>
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

@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@stop
