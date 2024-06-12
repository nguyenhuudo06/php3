@extends('layouts.admin')

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/product-create.js') }}"></script>
@endpush

@section('content')
    <div class="content-wrapper d-flex justify-content-center">
        <div class="col-lg-8 px-0 mt-4">
            <div class="card">
                <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            @error('name')
                                <span class="text-danger"><i>* {{ $message }}</i></span>
                            @enderror
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                placeholder="Enter name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Price</label>
                            @error('price')
                                <span class="text-danger"><i>* {{ $message }}</i></span>
                            @enderror
                            <input type="text" name="price" class="form-control" id="exampleInputEmail2"
                                placeholder="Enter price" value="{{ old('price') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail3">Quantity</label>
                            @error('quantity')
                                <span class="text-danger"><i>* {{ $message }}</i></span>
                            @enderror
                            <input type="text" name="quantity" class="form-control" id="exampleInputEmail3"
                                placeholder="Enter quantity" value="{{ old('quantity') }}">
                        </div>
                        <div class="form-group">
                            @error('feature_image_path')
                                <span class="text-danger"><i>* {{ $message }}</i></span>
                            @enderror
                            <input type="file" name="feature_image_path" multiple>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            @error('description')
                                <span class="text-danger"><i>* {{ $message }}</i></span>
                            @enderror
                            <textarea id="textarea" name="description" class="textarea" placeholder="Place some text here"
                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category_id">
                                <option value="0">Select category</option>
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
    </div>
@endsection
