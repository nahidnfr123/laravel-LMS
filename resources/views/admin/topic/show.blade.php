@extends('layouts.admin')

@section('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 font-weight-bold">{{ $semester->title }}</h3>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
                <a href="{{route('admin.semester.edit', $semester->id)}}" class="btn btn-sm bg-white btn-icon-text border">
                    <i class="typcn typcn-pencil mr-2"></i>Edit
                </a>
                <a href="{{route('admin.topic.create', ['semester_id'=>$semester->id])}}" class="btn btn-xs btn-success rounded-lg">
                    <i class="typcn typcn-plus mr-2"></i> Add Topic
                </a>
            </div>
        </div>
    </div>
    <div class="row  mt-3">
        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="display">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Short Title</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($semester->topic as $topic)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.semester.show', $topic->id) }}">
                                        <strong>{{$topic->title}}</strong>
                                    </a>
                                </td>
                                <td>{{$topic->short_title}}</td>
                                <td>{{$topic->duration}}</td>
                                <td>
                                    <form action="{{ route('admin.topic.destroy', $topic->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        @can('update_topic')
                                            <a href="{{route('admin.topic.edit', $topic->id)}}" class="btn btn-xs btn-primary rounded-lg">
                                                <i class="typcn typcn-pencil mr-2"></i>Edit
                                            </a>
                                        @endcan

                                        @can('delete_topic')
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
