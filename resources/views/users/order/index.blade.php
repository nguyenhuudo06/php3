@extends('layouts.users')

@section('content')
    <div class="container-fluid page-header"></div>

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    @foreach ($data['data']['list'] as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-truck-fast d-block" style="font-size: 24px;"></i>
                                </div>
                            </td>
                            <td class="text-danger fw-bold">{{ $item->id }}</td>
                            <td>{{ $item->customer_name }}</td>
                            <td>{{ $item->customer_phone }}</td>
                            <td>{{ $item->customer_zipcode }}</td>
                            <td>{{ $item->total_amount }}</td>
                            <td class="text-info">status: {{ $item->status }}</td>
                            <td>Payment: {{ $item->payment_status }}</td>
                            <td>{{ $item->customer_address }}</td>
                            <td>
                                <form action="{{ route('vnpay_payment', ['id' => $item->id, 'total' => $item->total_amount]) }}" method="POST">
                                    @csrf
                                    <button type="submit" name="redirect" class="btn btn-sm rounded-circle bg-light border btn-plus">
                                        VNPay
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/users/js/ajax-cart.js') }}"></script>
@endpush
