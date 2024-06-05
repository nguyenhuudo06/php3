@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        @error('email')
                            <span class="text-danger"><i>* {{ $message }}</i></span>
                        @enderror
                        <input type="text" name="email" class="form-control" id="exampleInputEmail1" value="{{ old('email') }}" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2">Name</label>
                        @error('name')
                            <span class="text-danger"><i>* {{ $message }}</i></span>
                        @enderror
                        <input type="text" name="name" class="form-control" id="exampleInputEmail2" value="{{ old('name') }}" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Password</label>
                        @error('password')
                            <span class="text-danger"><i>* {{ $message }}</i></span>
                        @enderror
                        <input type="text" name="password" class="form-control" id="exampleInputEmail3" value="{{ old('password') }}" placeholder="Enter password">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
