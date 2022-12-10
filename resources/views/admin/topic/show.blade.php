@extends('layouts.admin')

@section('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 font-weight-bold">{{ $topic->title }}</h3>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
                @can('edit_topic')
                    <a href="{{route('admin.topic.edit', $topic->id)}}" class="btn btn-sm bg-white btn-icon-text border">
                        <i class="typcn typcn-pencil mr-2"></i>Edit
                    </a>
                @endcan
            </div>
        </div>
    </div>
    <div class="row  mt-3">
        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3>Classes</h3>
                    <hr class="mb-2">
                    <table id="datatable" class="display">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date Time</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topic->clas as $clas)
                            <tr>
                                <td>
                                    <strong>{{$topic->title}}</strong>
                                </td>
                                <td>{{$clas->date_time}}</td>
                                <td>{{$clas->duration}}</td>
                                <td>
                                    <form action="{{ route('admin.clas.destroy', $clas->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        @can('update_clas')
                                            <a href="{{route('admin.clas.edit', $clas->id)}}" class="btn btn-xs btn-primary rounded-lg">
                                                <i class="typcn typcn-pencil mr-2"></i>Edit
                                            </a>
                                        @endcan

                                        @can('delete_clas')
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
