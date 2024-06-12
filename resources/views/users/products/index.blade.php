@extends('layouts.users')

@section('content')
    <div class="container-fluid page-header"></div>

    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input id="search" type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits">Default Sorting:</label>
                                <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                    form="fruitform">
                                    <option value="volvo">Nothing</option>
                                    <option value="saab">Popularity</option>
                                    <option value="opel">Organic</option>
                                    <option value="audi">Fantastic</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                        </div>
                        <div class="col-lg-9">
                            <div id="product-list" class="row g-4 justify-content-center">
                                @foreach ($data['data']['list'] as $item)
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div
                                            class="rounded position-relative fruite-item border border-secondary border-top-0 rounded-bottom">
                                            <div class="fruite-img">
                                                <img src="{{ $item->feature_image_path }}"
                                                    class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            @if (isset($item->category_id))
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                    style="top: 10px; left: 10px;">{{ $item->category?->name }}</div>
                                            @endif
                                            <div class="p-4">
                                                <h4>{{ $item->name }}</h4>
                                                <p>{{ $item->price }}</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <a href="{{ route('users.products.details', ['id' => $item->id]) }}"
                                                        class="flex-grow-1 btn btn-sm btn-outline-primary rounded-pill px-3 me-lg-2 mb-2 mb-lg-0 mt-1"><i
                                                            class="fas fa-eye me-1"></i> Views</a>
                                                    <form action="{{ route('cart.add') }}" method="POST" class="d-block flex-grow-1 mt-1">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-primary rounded-pill px-3"><i
                                                                class="fa fa-shopping-bag me-1"></i> Add to
                                                            cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                                <div class="col-12">
                                    {{ $data['data']['list']->links('partials.pagination') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
