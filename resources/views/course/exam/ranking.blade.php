@extends('layouts.home')

@section('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('content')
    <div id="overviews" class="section wb">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <h2 class="mb-0 font-weight-bold">{{$content->title}} : Ranking</h2>
                </div>
            </div>

            <div class="row  mt-3">
                <div class="col-12">
                    @if($results)
                        <table id="datatable" class="display">
                            <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Student</th>
                                <th>Marks</th>
                                <th>Duration</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($results as $key => $result)
                                <tr>
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>
                                        <strong>{{ $result->user->name}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $result->obtained_mark}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $result->duration}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $result->status}}</strong>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    @endif
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
