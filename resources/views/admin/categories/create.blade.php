@extends('layouts.admin')

@section('content')
<div class="content-wrapper d-flex justify-content-center">
    <div class="col-lg-8 px-0 mt-4">
        <div class="card">
            <form action="{{ route('admin.categories.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail2">Name</label>
                        @error('name')
                            <span class="text-danger"><i>* {{ $message }}</i></span>
                        @enderror
                        <input type="text" name="name" class="form-control" id="exampleInputEmail2"
                            value="{{ old('name') }}" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label>Parent category</label>
                        <select class="form-control" name="parent_id">
                            <option value="0">Chọn danh mục cha</option>
                            {{ $data['data']['categories'] }}
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
