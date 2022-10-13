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
                <a href="{{ route('admin.course.create') }}" class="btn btn-sm bg-white btn-icon-text border">
                    <i class="typcn typcn-plus mr-2"></i>Add
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
                            <th>Course</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.course.show', $course->id) }}">
                                        <img src="{{$course->photo}}" alt="" height="60" class="rounded-lg">
                                        <div class="mt-1">
                                            <strong>{{$course->title}}</strong>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <strong>{{ $course->status ? 'Active' : 'Inactive'}}</strong>
                                </td>
                                <td>
                                    <strong>{{ $course->featured ? 'Featured' : 'Not Featured'}}</strong>
                                </td>
                                <td>
                                    <form action="{{ route('admin.course.destroy', $course->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <a href="{{route('admin.course.edit', $course->id)}}" class="btn btn-xs btn-primary rounded-lg"><i class="typcn typcn-pencil mr-2"></i>Edit</a>
                                        <button type="submit" class="btn btn-xs btn-danger rounded-lg"><i class="typcn typcn-trash mr-2"></i>Delete</button>
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
