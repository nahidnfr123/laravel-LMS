@extends('layouts.admin')

@section('head')

@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 font-weight-bold">Manage users</h3>
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
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('admin.user.manageUpdate', $user->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf()
                            @method('POST')
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td>{{$user->name}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Phone</th>
                                            <td>{{$user->phone}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Dob</th>
                                            <td>{{$user->dob}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Gender</th>
                                            <td>{{$user->gender}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Role</th>
                                            <td>{{$user->role}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h2>Permission:</h2>
                                    <div class="row">
                                        @foreach($permissions as $permission)
                                            <div class="col-4">
                                                <div class="form-check form-check-flat form-check-primary">
                                                    <label class="form-check-label">
                                                        <input
                                                            type="checkbox"
                                                            class="form-check-input"
                                                            @if (old('permissions')) checked @elseif(in_array($permission->name, $userPermissions, false)) checked @endif
                                                            name="permissions[]"
                                                            value="{{$permission->id}}">
                                                        {{ ucwords(str_replace("_"," ",$permission->name)) }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@stop
