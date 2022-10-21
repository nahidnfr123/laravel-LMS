@extends('layouts.admin')

@section('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 font-weight-bold">Community Post</h3>
            <p></p>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <div class="pr-1 mb-3 mr-2 mb-xl-0">
                @can('view_community_post')
                    <a href="{{ route('admin.community_post.create') }}" class="btn btn-sm bg-white btn-icon-text border">
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
                            <th>Course</th>
                            <th>User</th>
                            <th>Publish at</th>
                            <th>Is Published</th>
                            <th>Is Public</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($communityPosts as $post)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.community_post.show', $post->id) }}">
                                        <img src="{{$post->photo}}" alt="" height="60" class="rounded-lg">
                                        <div class="mt-1">
                                            <strong>{{$post->title}}</strong>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <strong>{{ $post->user->name}}</strong>
                                </td>
                                <td>
                                    <strong>{{ $post->publish_at}}</strong>
                                </td>
                                <td>
                                    <strong>{{ $post->is_published ? 'Published' : 'Not Published'}}</strong>
                                </td>
                                <td>
                                    <strong>{{ $post->is_public ? 'Public' : 'Private'}}</strong>
                                </td>
                                <td>
                                    <form action="{{ route('admin.community_post.destroy', $post->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        @can('update_community_post')
                                            <a href="{{route('admin.community_post.edit', $post->id)}}" class="btn btn-xs btn-primary rounded-lg"><i class="typcn typcn-pencil mr-2"></i>Edit</a>
                                        @endcan

                                        @can('delete_community_post')
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
