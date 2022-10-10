@extends('layouts.admin')

@section('head')

@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 font-weight-bold">{{ $content->title }}</h3>
            <p class="mt-2">
                Status: <strong>{{ $content->status ? 'Active' : 'Inactive'}}</strong>,
                Total Mcqs: <strong>{{ count($content->exam->mcqs) }}</strong>,
                Marks: <strong>{{ count($content->exam->mcqs) * $content->exam->per_question_mark ?? 1 }}</strong>
            </p>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="typcn typcn-file mr-2"></i> Import MCQ
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Import Excel File</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.mcq-import') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="modal-body">
                                    <input type="hidden" class="form-control" name="exam_id" value="{{$content->exam->id}}">
                                    <input type="hidden" class="form-control" name="content_id" value="{{$content->id}}">
                                    <input type="file" class="form-control" name="file">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="{{route('admin.mcq.create', ['content_id'=>$content->id])}}" class="btn btn-sm bg-white btn-icon-text border">
                    <i class="typcn typcn-plus mr-2"></i> Add MCQ
                </a>
                <a href="{{route('admin.content.edit', $content->id)}}" class="btn btn-sm bg-white btn-icon-text border">
                    <i class="typcn typcn-pencil mr-2"></i>Edit
                </a>
            </div>
        </div>
    </div>

    <div class="row  mt-3">

        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    {{--                    {!! html_entity_decode($post->body) !!}--}}
                    @if($content->exam)
                        @if(count($content->exam->mcqs) > 0)
                            <div class="row">
                                @foreach($content->exam->mcqs as $mcq)
                                    <div class="col-6 d-flex grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                {!! $mcq->question !!}
                                                <div class="form-group">
                                                    @foreach(['a', 'b', 'c', 'd', 'e'] as $option)
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="mcq-{{$mcq->id}}" id="{{$mcq->id . $mcq[$option]}}" value="{{$option}}"
                                                                       @if($mcq->answer === $option) checked @else disabled @endif>
                                                                {{$mcq[$option]}}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <form action="{{ route('admin.mcq.destroy', $mcq->id) }}" class="d-flex mt-2 ml-2" method="POST" style="width: 260px">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <div>
                                                        <a href="{{route('admin.mcq.edit', [$mcq->id, 'content_id'=>$content->id])}}" class="btn btn-xs btn-primary rounded-lg mr-1">
                                                            <i class="typcn typcn-pencil mr-2"></i>Edit
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <button type="submit" class="btn btn-xs btn-danger rounded-lg">
                                                            <i class="typcn typcn-trash mr-2"></i>Delete
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                                @endif
                            </div>
                </div>
            </div>
        </div>
@endsection

@section('script')

@stop

