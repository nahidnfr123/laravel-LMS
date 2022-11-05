@extends('layouts.admin')

@section('head')

@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            @if($batch)
                <h3>{{$batch->batch_id}} - Students,</h3>
                <hr class="mb-2">
            @else
                <h3 class="mb-0 font-weight-bold">All Students</h3>
            @endif
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <div class="pr-1 mb-3 mr-2 mb-xl-0">

            </div>
        </div>
    </div>

    <div class="row  mt-3">
        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Add Mark</h4>
                    <hr>
                    <form action="{{ route('admin.marks.store') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <input type="hidden" name="semester_id" value="{{old('semester_id',  $batch->semester->id )}}">
                        <input type="hidden" name="user_id" value="{{old('user_id', $user->id )}}">
                        <div class="row">
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="topic_id">Topic:</label>
                                    <select id="topic_id" name="topic_id" class="form-control @error('topic_id') is-invalid @enderror" style="padding: 20px;" required>
                                        <option value="">Select</option>
                                        @foreach($topics as $topic)
                                            <option value="{{$topic->id}}" @if (old('topic_id') === $topic->id) selected @endif>{{$topic->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="total_mark">Total Mark:</label>
                                    <input type="text" name="total_mark" id="total_mark" value="{{old('total_mark', )}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="obtained_mark">Obtained Mark:</label>
                                    <input type="text" name="obtained_mark" id="obtained_mark" value="{{old('obtained_mark', )}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" style="padding: 20px;" required>
                                        <option value="">Select</option>
                                        <option value="distinction" @if (old('status') === 'distinction') selected @endif>Distinction</option>
                                        <option value="merit" @if (old('status') === 'merit') selected @endif>Merit</option>
                                        <option value="pass" @if (old('status') === 'pass') selected @endif>Pass</option>
                                        <option value="fail" @if (old('status') === 'fail') selected @endif>Fail</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@stop
