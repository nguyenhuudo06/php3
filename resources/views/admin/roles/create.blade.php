@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="px-0 mt-4">
            <div>
                <form action="{{ route('admin.roles.store') }}" method="post" enctype="multipart/form-data">
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
                            <label>Display name</label>
                            @error('display_name')
                                <span class="text-danger"><i>* {{ $message }}</i></span>
                            @enderror
                            <textarea name="display_name" placeholder="Place some text here"
                                style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('display_name') }}</textarea>
                        </div>
                        <div class="row">
                            @foreach ($data['config']['permissionParent'] as $itemParent)
                                <div class="card border-primary mb-3 col-md-12">
                                    <div class="card-header bg-success bg-gradient">
                                        <input type="checkbox" class="checkbox_wrapper" id="">
                                        <label for="">{{ $itemParent->name }}</label>
                                    </div>
                                    <div class="card-body row text-primary">
                                        @foreach ($itemParent->permissionChildren as $itemChildren)
                                            <div class="card-title col-md-3">
                                                <input type="checkbox" class="checkbox_children" name="permission_id[]" value={{ $itemChildren->id }}>
                                                <label for="">{{ $itemChildren->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
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

@section('js')
<script>
    $('.checkbox_wrapper').on('click', function() {
        $(this).closest('.card').find('.checkbox_children').prop('checked', $(this).prop('checked'))
    })
</script>
@endsection