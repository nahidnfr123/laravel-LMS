@extends('layouts.admin')

@section('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            @if($semester)
                <h3>{{$semester->title}} - Batch,</h3>
                <hr class="mb-2">
            @else
                <h3 class="mb-0 font-weight-bold">All Batch</h3>
                <p></p>
            @endif
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
                @can('view_batch')
                    <a href="{{ route('admin.batch.create') }}" class="btn btn-sm bg-white btn-icon-text border">
                        <i class="typcn typcn-plus mr-2"></i>Add
                    </a>
                @endcan
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
                            <th>Batch</th>
                            <th>Subject</th>
                            <th>Semester</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($batch as $b)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.batch.show', $b->id) }}">
                                        <strong>{{$b->batch_id}}</strong>
                                    </a>
                                </td>
                                <td>{{$b->subject->title}}</td>
                                <td>{{$b->semester->title}}</td>
                                <td>
                                    <form action="{{ route('admin.batch.destroy', $b->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="{{route('admin.user.create', $b->id)}}" class="btn btn-xs btn-success rounded-lg">
                                            <i class="typcn typcn-plus mr-2"></i>Add Student
                                        </a>
                                        @can('update_batch')
                                            <a href="{{route('admin.batch.edit', $b->id)}}" class="btn btn-xs btn-primary rounded-lg">
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
