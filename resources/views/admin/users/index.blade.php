@extends('layouts.admin')

@section('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 font-weight-bold">Manage users</h3>
            <p></p>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
                <a href="{{ route('admin.user.create') }}" class="btn btn-sm bg-white btn-icon-text border">
                    <i class="typcn typcn-plus mr-2"></i>Add
                </a>
            </div>
        </div>

        <div class="row  mt-3">
            <div class="col-12 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable" class="display">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <strong>{{ $user->name}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{$user->email}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $user->role}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $user->created_at}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $user->status }}</strong>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <a href="{{route('admin.user.manage', $user->id)}}" class="btn btn-xs btn-success rounded-lg"><i class="typcn typcn-pencil mr-2"></i>Details</a>
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
