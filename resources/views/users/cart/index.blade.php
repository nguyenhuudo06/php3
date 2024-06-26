@extends('layouts.users')

@section('content')
    <div class="container-fluid page-header"></div>

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                @if ($data['data']['list']->isEmpty())
                    <p>Your cart is empty</p>
                @else
                    <table id="cart-table" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Products</th>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['data']['list'] as $item)
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item?->product?->feature_image_path }}"
                                                class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                                alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4">{{ $item?->product?->name }}</p>
                                    </td>
                                    {{-- <td>
                                        <div class="input-group mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm text-center border-0"
                                                value="{{ $item?->quantity }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td> --}}
                                    <td>
                                        <div class="input-group mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm rounded-circle bg-light border btn-minus"
                                                    data-url="{{ route('cart.update', $item->id) }}"
                                                    data-id="{{ $item->id }}">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm text-center border-0 cart-quantity"
                                                data-url="{{ route('cart.update', $item->id) }}"
                                                data-id="{{ $item->id }}" value="{{ $item->quantity }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm rounded-circle bg-light border btn-plus"
                                                    data-url="{{ route('cart.update', $item->id) }}"
                                                    data-id="{{ $item->id }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4 product-price">{{ $item->product->price }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4 product-total">
                                            {{ number_format($item->quantity * $item->product->price, 2) }}</p>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-md rounded-circle bg-light border mt-4">
                                                <i class="fa fa-times text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="mt-5">
                <input type="text" class="border-0 border-bottom rounded me-5 p-3 mb-4" placeholder="Coupon Code">
                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply
                    Coupon</button>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="mb-4">Cart total</h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <div class="">
                                    <span>VNĐ</span>
                                    <span class="product-total mb-0">{{ number_format($data['data']['total'], 2) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <div class="">
                                <span>VNĐ</span>
                                <span
                                    class="product-total-2 mb-0 pe-4">{{ number_format($data['data']['total'], 2) }}</span>
                            </div>
                        </div>
                        <a href="{{ route('checkout.index') }}"
                            class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                            type="button">Proceed Checkout</a>
                        {{-- <form action="{{ route('vnpay_payment') }}" method="post">
                            @csrf
                            <button name="redirect" type="submit">VNPAY</button>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/users/js/ajax-cart.js') }}"></script>
@endpush
