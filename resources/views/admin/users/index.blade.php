@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-info"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @if (isset($data['data']['list']) && is_object($data['data']['list']))
                                        @foreach ($data['data']['list'] as $user)
                                            <tr>
                                                <td style="width: 40px;">{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                {{-- <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" checked
                                                            id="customSwitch{{ $user->id }}">
                                                        <label class="custom-control-label" for="customSwitch{{ $user->id }}"></label>
                                                    </div>
                                                </td> --}}
                                                <td>
                                                    <button type="button" class="btn btn-primary"><i class="fa fa-pencil"
                                                            aria-hidden="true"></i></i></button>
                                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash"
                                                            aria-hidden="true"></i></button>
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
