@extends('layouts.admin')

@section('head')
@stop

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 font-weight-bold">Create users</h3>
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
                        <form action="{{route('admin.user.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf()
                            @method('POST')
                            <div class="row">
                                <div class="col-12 col-sm-6 mb-3">
                                    <input type="hidden" hidden value="{{$_GET['batch_id'] || ''}}" name="batch_id">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{old('name')}}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="phone">Phone:</label>
                                        <input type="tel" name="phone" id="phone"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               value="{{old('phone')}}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">email:</label>
                                        <input type="email" name="email" id="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{old('email')}}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" name="password" id="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               value="{{old('password')}}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="dob">Dob:</label>
                                        <input type="date" name="dob" id="dob"
                                               class="form-control @error('dob') is-invalid @enderror"
                                               value="{{old('dob')}}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="avatar">Avatar:</label>
                                        <input type="file" name="avatar" id="avatar"
                                               class="form-control @error('avatar') is-invalid @enderror">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="role">Role:</label>
                                        <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" style="padding: 20px;">
                                            <option value="student" @if (old('role')) selected @endif>Student</option>
                                            <option value="teacher" @if (old('role')) selected @endif>Teacher</option>
                                            <option value="admin" @if (old('role')) selected @endif>Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label>Gender:</label>
                                        <div class="form-control">
                                            <label style="margin-right: 20px">
                                                <input type="radio" name="gender" value="male" @if (old('gender')) checked @endif> Male
                                            </label>
                                            <label>
                                                <input type="radio" name="gender" value="female" @if (old('gender')) checked @endif> Female
                                            </label>
                                        </div>
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
