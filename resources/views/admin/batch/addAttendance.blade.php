@extends('layouts.admin')

@section('content')
    <div class="row  mt-3">
        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h1>
                        @if ($batch->created_at)
                            Edit Batch
                        @else
                            Add Batch
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
                        @if ($batch->id)
                            @method('PUT')
                        @else
                            @method('POST')
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-6 form-group">
                                <label for="batch_id">Batch Id</label>
                                <input
                                    type="text"
                                    class="form-control @error('batch_id') is-invalid @enderror"
                                    id="batch_id"
                                    name="batch_id"
                                    placeholder="batch_id"
                                    value="{{old('batch_id', $batch->batch_id)}}"
                                >
                            </div>
                            <div class="col-12 col-sm-6 form-group">
                                <label for="subject_id">Subject</label>
                                <select class="form-select" id="subject_id" aria-label="multiple select example" name="subject_id">
                                    <option selected></option>
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}"
                                                @if(old('subject_id', $batch->subject && $subject->id === $batch->subject->id)) selected @endif>
                                            {{$subject->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 form-group">
                                <label for="semester_id">Semester</label>
                                <select class="form-select" id="semester_id" aria-label="multiple select example" name="semester_id">
                                    <option selected></option>
                                    @foreach($semesters as $semester)
                                        <option value="{{$semester->id}}"
                                                @if(old('semester_id', $batch->semester && $semester->id === $batch->semester->id)) selected @endif>
                                            {{$semester->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
