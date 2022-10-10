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
                        @if ($mcq->created_at)
                            Edit Mcq
                        @else
                            Add Mcq
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
                    <!-- Modal -->
                    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                        @if ($mcq->created_at)
                            @method('PUT')
                        @else
                            @method('POST')
                        @endif
                        @csrf
                        <input type="hidden"
                               class="form-control @error('exam_id') is-invalid @enderror" id="exam_id"
                               name="exam_id" value="{{old('exam_id', $content->exam->id)}}"
                        >
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="editor">Question</label>
                                <textarea
                                    class="form-control @error('question') is-invalid @enderror"
                                    id="editor"
                                    placeholder="Enter the Question"
                                    name="question"
                                    style="min-height: 200px"
                                >{{old('question', $mcq->question)}}</textarea>
                            </div>
                            <div class="col-12 col-sm-6 form-group">
                                <label for="a">a</label>
                                <input type="text"
                                       class="form-control @error('a') is-invalid @enderror" id="a"
                                       name="a" value="{{old('a', $mcq->a)}}"
                                >
                            </div>
                            <div class="col-12 col-sm-6 form-group">
                                <label for="b">b</label>
                                <input type="text"
                                       class="form-control @error('b') is-invalid @enderror" id="b"
                                       name="b" value="{{old('b', $mcq->b)}}"
                                >
                            </div>
                            <div class="col-12 col-sm-6 form-group">
                                <label for="c">c</label>
                                <input type="text"
                                       class="form-control @error('c') is-invalid @enderror" id="c"
                                       name="c" value="{{old('c', $mcq->c)}}"
                                >
                            </div>
                            <div class="col-12 col-sm-6 form-group">
                                <label for="d">d</label>
                                <input type="text"
                                       class="form-control @error('d') is-invalid @enderror" id="d"
                                       name="d" value="{{old('d', $mcq->d)}}"
                                >
                            </div>
                            <div class="col-12 col-sm-6 form-group">
                                <label for="e">e</label>
                                <input type="text"
                                       class="form-control @error('e') is-invalid @enderror" id="e"
                                       name="e" value="{{old('e', $mcq->e)}}"
                                >
                            </div>
                            <div class="col-12 col-sm-6 form-group">
                                <label for="answer">answer</label>
                                <select name="answer" id="answer" class="form-control py-3 @error('answer') is-invalid @enderror">
                                    <option value="" selected>-- Select --</option>
                                    <option value="a" @if(old('answer', $mcq->answer) === 'a') selected @endif>a</option>
                                    <option value="b" @if(old('answer', $mcq->answer) === 'b') selected @endif>b</option>
                                    <option value="c" @if(old('answer', $mcq->answer) === 'c') selected @endif>c</option>
                                    <option value="d" @if(old('answer', $mcq->answer) === 'd') selected @endif>d</option>
                                    <option value="e" @if(old('answer', $mcq->answer) === 'e') selected @endif>e</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
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
