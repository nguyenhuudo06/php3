@extends('layouts.users')

@section('content')
    <div class="container-fluid page-header"></div>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="form-item">
                            <label class="form-label my-3"><sup class="text-danger">(*)</sup>Name</sup></label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $data['data']['user']?->name) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3"><sup class="text-danger">(*)</sup>Address</sup></label>
                            <input type="text" class="form-control" name="address"
                                value="{{ old('address', $data['data']['user']?->address) }}">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3"><sup class="text-danger">(*)</sup>Phone</sup></label>
                            <input type="text" class="form-control" name="phone"
                                value="{{ old('phone', $data['data']['user']?->phone) }}">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3"><sup class="text-danger">(*)</sup>Postcode/Zip</sup></label>
                            <input type="tel" class="form-control" name="postcode" value="{{ old('postcode') }}">
                            @error('postcode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <hr>
                        <div class="form-item">
                            <textarea name="notes" class="form-control" spellcheck="false" cols="30" rows="11"
                                placeholder="Order Notes">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['data']['cart'] as $item)
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="{{ $item->product?->feature_image_path }}"
                                                        class="img-fluid rounded-circle" style="width: 90px; height: 90px;"
                                                        alt="">
                                                </div>
                                            </th>
                                            <td class="py-5">{{ $item->product?->name }}</td>
                                            <td class="py-5">{{ $item->product?->price }}</td>
                                            <td class="py-5">{{ $item->quantity }}</td>
                                            <td class="py-5">
                                                {{ number_format($item->quantity * $item->product?->price, 2, ',   ', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th scope="row">
                                        </th>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                        </td>
                                        <td class="py-5"></td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark">VNĐ {{ number_format($data['data']['total'], 2, ',   ', '.') }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="cashOnDelivery" name="payment_method" value="cash">
                                    <label class="form-check-label" for="cashOnDelivery">Cash On Delivery</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="vnpay" name="payment_method" value="vnpay">
                                    <label class="form-check-label" for="vnpay">VNPay</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place
                                Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
