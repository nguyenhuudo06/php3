@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Parent id</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @if (isset($data['data']['list']) && is_object($data['data']['list']))
                                        @foreach ($data['data']['list'] as $user)
                                            <tr>
                                                <td style="width: 40px;">{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->parent_id }}</td>
                                                <td>{{ $user->slug }}</td>
                                                <td>
                                                    <a href="{{ route('admin.categories.edit', ['id' => $user->id]) }}" class="btn text-light btn-primary"><i class="fa fa-pencil"
                                                            aria-hidden="true"></i></a>
                                                    <a href="{{ route('admin.categories.delete', ['id' => $user->id]) }}" class="btn text-light btn-danger"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
