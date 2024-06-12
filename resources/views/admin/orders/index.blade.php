@extends('layouts.admin')

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
                                    <th>User</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($data['data']['list'] as $item)
                                        <tr id="order-{{ $item->id }}">
                                            <td style="width: 40px;">{{ $item->id }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->total_amount }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <a href="" class="btn text-light btn-info"><i
                                                        class="fa-regular fa-eye"></i></a>
                                                <a href="" class="btn text-light btn-primary"><i class="fa fa-pencil"
                                                        aria-hidden="true"></i></a>
                                                <button class="btn text-light btn-danger delete-product" data-id="{{ $item->id }}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
