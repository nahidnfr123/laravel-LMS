@extends('layouts.admin')

@section('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 font-weight-bold">Orders</h3>
            <p></p>
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
                    <table id="datatable" class="display">
                        <thead>
                        <tr>
                            <th>Course</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Transaction Id</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    {{$order->course->title}}
                                </td>
                                <td>
                                    {{$order->user->name}}
                                </td>
                                <td>
                                    {{$order->amount}}
                                </td>
                                <td>
                                    {{$order->status}}
                                </td>
                                <td>
                                    {{$order->transaction_id}}
                                </td>
                                <td>
                                    {{$order->created_at}}
                                </td>
                                <td>
                                    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        @if($order->status !== 'rejected')
                                            @can('reject_order')
                                                <a href="{{route('admin.orders.reject', $order->id)}}" class="btn btn-xs btn-primary rounded-lg">
                                                    Reject Payment
                                                </a>
                                            @endcan
                                        @else
                                            @can('accept_order')
                                                <a href="{{route('admin.orders.accept', $order->id)}}" class="btn btn-xs btn-success rounded-lg">
                                                    Accept Payment
                                                </a>
                                            @endcan
                                        @endif
                                        {{--                                        <button type="submit" class="btn btn-xs btn-danger rounded-lg"><i class="typcn typcn-trash mr-2"></i>Delete</button>--}}
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
