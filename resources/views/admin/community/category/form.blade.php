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
                        @if ($communityCategory->created_at)
                            Edit Community Category
                        @else
                            Add Community Category
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
                        @if ($communityCategory->created_at)
                            @method('PUT')
                        @else
                            @method('POST')
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6 form-group">
                                <label for="name">name</label>
                                <input
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    placeholder="name"
                                    value="{{old('name', $communityCategory->name)}}"
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
                                >{{old('description', $communityCategory->description)}}</textarea>
                            </div>
                            <div class="col-12 col-sm-6 mt-4">
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            @if (old('active', $communityCategory->active)) checked @endif
                                            name="active"
                                            value="1">
                                        active
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
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@stop
