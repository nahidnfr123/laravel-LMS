@extends('layouts.admin')

@section('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            @if($batch)
                <h3>Batch: {{$batch->batch_id}} - Students Report,</h3>
                <hr class="mb-2">
            @else
                <h3 class="mb-0 font-weight-bold">All Students</h3>
                <p></p>
            @endif
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
            </div>
        </div>
    </div>

    <div class="row  mt-3">
        @php
            $topicIds = [];
            $topics = $batch->semester->topics;
            if(!empty($topics)){
            $topicIds = $topics->pluck('id');
            }
        @endphp
        <div class="col-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="display">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Subjects</th>
                            <th>Marks</th>
                            <th>Attendance</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <strong>{{$user->s_id}}</strong>
                                </td>
                                <td>
                                    <strong>{{$user->name}}</strong>
                                </td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach($user->topics as $topic)
                                        @php
                                            $status = ['bad', 'moderate', 'good', 'excellent'];
                                        @endphp
                                        <div>
                                            <strong>{{$topic->title}}</strong>
                                        </div>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($user->topics as $topic)
                                        @php
                                            $marks = $topic->marks->where('user_id',$user->id)->first();
                                        @endphp
                                        <div>
                                            <strong>{{ strtoupper($topic->short_title)}}: </strong>
                                            @if(!empty($marks))
                                                @php
                                                    $color = '';
                                                    if(ucwords($marks->status) === 'Distinction' || ucwords($marks->status) === 'Distinction Plus'){
                                                        $color = 'text-success';
                                                    }else if(ucwords($marks->status) === 'Merit'){
                                                        $color = 'text-info';
                                                    }else if(ucwords($marks->status) === 'Pass'){
                                                        $color = 'text-warning';
                                                    }else{
                                                        $color = 'text-danger';
                                                    }
                                                @endphp
                                                {{--                                                {{$topicIds}}--}}
                                                {{--                                                @if (in_array($topic->id, $topicIds))--}}
                                                {{--                                                @else--}}
                                                <strong class="text-success">{{$marks->obtained_mark}}</strong> / <strong>{{$marks->total_mark}}</strong>,
                                                <strong class="{{$color}}">{{$marks->status}}</strong>
                                                {{--                                                @endif--}}
                                            @else
                                                <strong class="ml-3">---</strong>
                                            @endif
                                        </div>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($user->topics as $topic)
                                        @php
                                            $clasAttendances = $topic->clasAttendances->where('user_id',$user->id)->first();
                                        @endphp
                                        <div>
                                            <strong>{{ strtoupper($topic->short_title) }}: </strong>
                                            @if(!empty($clasAttendances))
                                                <strong class="text-success">{{$clasAttendances->attended_classes}}</strong> / <strong>{{$clasAttendances->total_classes}}</strong>
                                            @else
                                                <strong class="ml-3">---</strong>
                                            @endif
                                        </div>
                                    @endforeach
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
