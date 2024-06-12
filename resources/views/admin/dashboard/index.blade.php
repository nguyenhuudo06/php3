@extends('layouts.admin')

@push('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endpush

@section('content')
    <div class="content-wrapper" style="height: 600px">
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
@endsection
