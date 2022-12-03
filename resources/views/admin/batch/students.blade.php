@extends('layouts.admin')

@section('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            @if($batch)
                <h3>{{$batch->batch_id}} - Students,</h3>
                <hr class="mb-2">
            @else
                <h3 class="mb-0 font-weight-bold">All Students</h3>
                <p></p>
            @endif
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
                <a href="{{ route('admin.batch.addMark', ['id'=>$batch->id]) }}" class="btn btn-sm btn-primary">Add Marks</a>
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
                        @foreach($batch->semester->topic as $topic)
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
                                    @foreach($user->batch->semester->topic as $topic)
                                        <div>
                                            <strong>{{$topic->title}}:</strong>
                                            @if($topic->mark)
                                                {{$topic->mark->obtained_mark.'/'.$topic->mark->total_mark}} ,
                                            @else
                                                <a
                                                    href="{{ route('admin.marks.create', ['batch_id'=>$batch->id, 'user_id'=>$user->id, 'topic_id'=>$topic->id]) }}"
                                                    class="btn btn-xs btn-success rounded-lg">Add Marks
                                                </a>
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
