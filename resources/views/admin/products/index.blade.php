@extends('layouts.admin')

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/product-index.js') }}"></script>
@endpush

@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Category</th>
                                    <th>User</th>
                                    <th>Brand</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($data['data']['list'] as $item)
                                        <tr id="product-{{ $item->id }}">
                                            <td style="width: 40px;">{{ $item->id }}</td>
                                            <td class="img-box">
                                                <img src="{{ $item->feature_image_path }}" alt="">
                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item?->category?->name }}</td>
                                            <td>{{ $item->user_id }}</td>
                                            <td>{{ $item->brand_id }}</td>
                                            <td>
                                                <a href="" class="btn btn-light"><i class="fa fa-pencil"
                                                        aria-hidden="true"></i></a>
                                                <button class="btn btn-light delete-product"
                                                    data-id="{{ $item->id }}"
                                                    data-url="{{ route('admin.products.delete', ['id' => $item->id]) }}"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
