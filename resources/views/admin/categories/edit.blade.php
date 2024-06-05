@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <form action="{{ route('admin.categories.update', ['id' => $data['data']['infor']->id]) }}" method="post">
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
                        <label>Parent category</label>
                        <select class="form-control" name="parent_id">
                            <option value="0">Chọn danh mục cha</option>
                            {{!! $data['data']['categories'] !!}}
                        </select>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
