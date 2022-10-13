@extends('layouts.admin')

@section('head')

@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 font-weight-bold">{{ $content->title }}</h3>
            <p class="mt-2">
                Status: <strong>{{ $content->status ? 'Active' : 'Inactive'}}</strong>,
                Total Submissions: <strong>{{ count($content->assignment->users) }}</strong>,
                Marks: <strong>{{ $content->assignment->total_mark }}</strong>
            </p>
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
                    {{--                    {!! html_entity_decode($post->body) !!}--}}
                    @if($content->assignment)
                        @if(count($content->assignment->users) > 0)
                            <div class="row">
                                @foreach($content->assignment->users as $user)
                                    <div class="col-12 d-flex grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <h4>{{$user->id}} - {{$user->name}}</h4>
                                                    @if(!empty($user) && $user->pivot->file)
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}">
                                                            <i class="typcn typcn-file mr-2"></i> Show
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{$user->name}}</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div>
                                                                        <iframe src="{{$user->pivot->file}}" style="min-height: 100%; max-width: 800px; max-height: 100%; margin: auto;" height="800px" width="100%"></iframe>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form action="{{ route('admin.assignment.update', $content->assignment->id) }}" method="post" class="d-flex">
                                                            @csrf()
                                                            @method('PUT')
                                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                                            <input type="hidden" name="assignment_id" value="{{$content->assignment->id}}">
                                                            <label for="marks{{$user->id}}" class="mr-2 mt-2">Marks</label>
                                                            <input type="text" class="form-control form-control-sm" id="marks{{$user->id}}" name="marks" required @if($user->pivot->marks) readonly @endif value="{{$user->pivot->marks ?? ''}}">
                                                            @if(!$user->pivot->marks)
                                                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                                            @endif
                                                        </form>
                                                    @endif
                                                </div>
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

