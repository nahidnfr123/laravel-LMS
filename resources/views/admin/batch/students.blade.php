@extends('layouts.admin')

@section('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            @if($batch)
                <h3>Batch: {{$batch->batch_id}} - Students,</h3>
                <hr class="mb-2">
            @else
                <h3 class="mb-0 font-weight-bold">All Students</h3>
                <p></p>
            @endif
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Import User
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Import User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.importUser') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="modal-body">
                                    <input type="hidden" class="form-control" name="batch_id" value="{{$batch->id}}" required>
                                    <input type="file" class="form-control" name="file" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal-marks">
                    Import Marks
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal-marks" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Import Marks</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.importMark') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="modal-body">
                                    <input type="hidden" class="form-control" name="batch_id" value="{{$batch->id}}">
                                    <div class="col-12 form-group">
                                        <label for="topic_id">Topic</label>
                                        <select class="form-select" id="topic_id" aria-label="multiple select example" name="topic_id" required>
                                            <option selected></option>
                                            @foreach($batch->semester->topics as $topic)
                                                <option value="{{$topic->id}}">{{$topic->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="total_mark">Total Mark</label>
                                        <input type="number" class="form-control" name="total_mark" id="total_mark" value="" required>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="file">File</label>
                                        <input type="file" class="form-control" name="file" id="file" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--                <a href="{{ route('admin.batch.addMark', ['id'=>$batch->id]) }}" class="btn btn-sm btn-primary">Add Marks</a>--}}
                <a href="{{ route('admin.batch.addAttendance', ['id'=>$batch->id]) }}" class="btn btn-sm btn-success">Add Attendance</a>
            </div>
        </div>
    </div>

    <div class="row  mt-3">
        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3>Topics</h3>
                    <div>
                        @foreach($batch->semester->topics as $topic)
                            <a href="{{route('admin.topic.show', $topic->id)}}" class="btn btn-sm btn-warning">{{$topic->title}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="display">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subjects</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($batch->users as $user)
                            <tr>
                                <td>
                                    <strong>{{$user->s_id}}</strong>
                                </td>
                                <td>
                                    <strong>{{$user->name}}</strong>
                                </td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>
                                    @foreach($user->topics as $topic)
                                        @php
                                            $marks = $topic->marks->where('user_id',$user->id)->first();
                                        @endphp
                                        <div>
                                            <strong>{{$topic->title}}</strong>
                                            @if(!empty($marks))
                                                <u class="text-success">Marks:</u> {{$marks->obtained_mark.'/'.$marks->total_mark}} ,
                                            @else
                                                {{-- <a href="{{ route('admin.marks.create', ['batch_id'=>$batch->id, 'user_id'=>$user->id, 'topic_id'=>$topic->id]) }}" --}}
                                                {{--    class="btn btn-xs btn-success rounded-lg">Add Marks --}}
                                                {{-- </a> --}}
                                            @endif
                                        </div>
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        @can('update_batch')
                                            <a href="{{route('admin.user.edit', $user->id)}}" class="btn btn-xs btn-primary rounded-lg">
                                                <i class="typcn typcn-pencil mr-2"></i>Edit
                                            </a>
                                        @endcan

                                        @can('delete_batch')
                                            <button type="submit" class="btn btn-xs btn-danger rounded-lg">
                                                <i class="typcn typcn-trash mr-2"></i>Delete
                                            </button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
@stop
