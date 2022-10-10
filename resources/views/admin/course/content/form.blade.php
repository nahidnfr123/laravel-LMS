@extends('layouts.admin')

@section('head')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

    <style>
        #assignment_form,
        #exam_form,
        #note_form,
        #recorded_class_form,
        #live_class_form,
        #pdf_form {
            display: none;
        }
    </style>
@stop

@section('content')
    <div class="row  mt-3">
        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1>
                        @if ($content->created_at)
                            Edit Content
                        @else
                            Add Content
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
                        @if ($content->created_at)
                            @method('PUT')
                        @else
                            @method('POST')
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6 form-group" style="visibility: hidden; position: absolute; opacity: 0">
                                <label for="section_id"></label>
                                <input
                                    type="text"
                                    class="form-control @error('section_id') is-invalid @enderror"
                                    id="section_id"
                                    name="section_id"
                                    placeholder="section_id"
                                    value="{{old('section_id', $content->section_id) ?? request()->get('section')}}"
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
                                    value="{{old('title', $content->title)}}"
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
                                    value="{{old('available_at', $content->available_at)}}"
                                >
                            </div>
                            <div class="col-12 col-sm-6 form-group">
                                <label for="content_type">Type</label>
                                <select name="type" id="content_type" onchange="UpdateFormElement(this)" class="form-control py-3 @error('type') is-invalid @enderror">
                                    <option value="" selected>-- Select --</option>
                                    <option value="assignment" @if(old('type', $content->type) === 'assignment') selected @endif>Assignment</option>
                                    <option value="exam" @if(old('type', $content->type) === 'exam') selected @endif>Exam</option>
                                    <option value="recorded_class" @if(old('type', $content->type) === 'recorded_class') selected @endif>Recorded class</option>
                                    <option value="live_class" @if(old('type', $content->type) === 'live_class') selected @endif>Live Class</option>
                                    <option value="note" @if(old('type', $content->type) === 'note') selected @endif>Note</option>
                                    <option value="pdf" @if(old('type', $content->type) === 'pdf') selected @endif>Pdf</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 mt-4">
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            @if (old('paid', $content->paid)) checked @endif
                                            name="paid"
                                            value="1">
                                        paid
                                    </label>
                                </div>
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            @if (old('status', $content->status)) checked @endif
                                            name="status"
                                            value="1">
                                        status
                                    </label>
                                </div>
                            </div>

                            <div id="assignment_form">@include('admin.course.content.assignment_form')</div>
                            <div id="exam_form">@include('admin.course.content.exam_form')</div>
                            <div id="class_form">@include('admin.course.content.class_form')</div>
                            <div id="note_form">@include('admin.course.content.note_form')</div>
                            <div id="pdf_form">@include('admin.course.content.pdf_form')</div>
                            <div id="common_form">@include('admin.course.content.common_form')</div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const forms = ['assignment_form', 'exam_form', 'class_form', 'note_form', 'pdf_form', 'common_form']

        function UpdateFormElement(e) {
            forms.forEach(o => {
                const el = document.getElementById(o)
                if (el) el.style.display = 'none'
            })
            const el = document.getElementById(e.value + '_form')
            if (el) el.style.display = 'block'
            if (['assignment', 'exam', 'live_class'].includes(e.value)) document.getElementById('common_form').style.display = 'block'
            if (['recorded_class', 'live_class'].includes(e.value)) document.getElementById('class_form').style.display = 'block'
        }

        UpdateFormElement(document.getElementById('content_type'))
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editorDescription'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editorNote'))
            .catch(error => {
                console.error(error);
            });
    </script>

@stop
