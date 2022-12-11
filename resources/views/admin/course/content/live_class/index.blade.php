@extends('layouts.admin')

@section('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 font-weight-bold">Courses</h3>
            <p></p>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
               {{-- <a href="{{ route('admin.course.create') }}" class="btn btn-sm bg-white btn-icon-text border">
                    <i class="typcn typcn-plus mr-2"></i>Add
                </a>--}}
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
                            <th>Course</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allAttendedUsers as $allAttendedUser)
                            <tr>
                                <td>
                                    <strong>{{$allAttendedUser['user']->name}}</strong>
                                </td>
                                <td>
                                    <strong class="@if(!$allAttendedUser['attended']) text-danger @endif">{{ $allAttendedUser['attended'] ? 'Attended' : 'Absent'}}</strong>
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
