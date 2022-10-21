@extends('layouts.admin')

@section('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 font-weight-bold">Contact us</h3>
            <p></p>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <div class="pr-1 mb-3 mr-2 mb-xl-0">

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
                                <th>Message</th>
                                <th>Created At</th>
                                <th>Replied</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>
                                        <strong>{{ $contact->name}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{$contact->email}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $contact->message}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $contact->created_at}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $contact->replied ? 'replied':''}}</strong>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.content-us.destroy', $contact->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            @can('update_contact')
                                                <a href="{{route('admin.content-us.edit', $contact->id)}}" class="btn btn-xs btn-primary rounded-lg"><i class="typcn typcn-pencil mr-2"></i>Reply</a>
                                            @endcan
                                            @can('delete_contact')
                                                <button type="submit" class="btn btn-xs btn-danger rounded-lg"><i class="typcn typcn-trash mr-2"></i>Delete</button>
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
