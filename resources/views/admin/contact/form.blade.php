@extends('layouts.admin')

@section('head')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
@stop

@section('content')
    <div class="row  mt-3">
        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1>Send Email</h1>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @can('view_contact')
                        <form class="forms-sample" action="{{ route('admin.content-us.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-12 col-sm-6 form-group">
                                    <label for="subject">Subject</label>
                                    <input
                                        type="text"
                                        class="form-control @error('subject') is-invalid @enderror"
                                        id="subject"
                                        name="subject"
                                        placeholder="subject"
                                        value="{{old('subject')}}"
                                    >
                                </div>
                                <div class="col-12 form-group">
                                    <label for="editor">description</label>
                                    <textarea
                                        class="form-control @error('message') is-invalid @enderror"
                                        id="editor"
                                        placeholder="Enter the message"
                                        name="message"
                                        style="min-height: 200px"
                                    >{{old('message')}}</textarea>
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
