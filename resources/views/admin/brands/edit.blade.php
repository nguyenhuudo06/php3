@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <form action="{{ route('admin.brands.update', ['id' => $data['data']['infor']->id]) }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail2">Name</label>
                        @error('name')
                            <span class="text-danger"><i>* {{ $message }}</i></span>
                        @enderror
                        <input type="text" name="name" class="form-control" id="exampleInputEmail2"
                        value="{{ $data['data']['infor']->name }}" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2">Description</label>
                        @error('description')
                            <span class="text-danger"><i>* {{ $message }}</i></span>
                        @enderror
                        <input type="text" name="description" class="form-control" id="exampleInputEmail2"
                        value="{{ $data['data']['infor']->description }}" placeholder="Enter name">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
