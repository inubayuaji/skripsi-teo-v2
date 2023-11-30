@extends('web.layouts.base')

@section('title', 'Shop')

@section('content')
<!-- Start Content -->
<div class="container py-5">
    @if(Session::has('fail_cart_add'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger">
                {{ Session::get('fail_cart_add') }}
                @php
                Session::forget('fail_cart_add');
                @endphp
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                @foreach($productList as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="{{ url('storage/' . $product->featured_image) }}">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white mt-2" href="{{ route('web.shop-single', ['id' => $product->id]) }}"><i class="far fa-eye"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="{{ route('action.cart_add', ['product_id' => $product->id, 'qty_ordered' => 1]) }}"><i class="fas fa-cart-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <a href="shop-single.html" class="h3 text-decoration-none">{{ $product->name }}</a>
                                <p class="mb-0">Rp{{ number_format($product->price, 2, '.', ',') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
<!-- End Content -->
@endsection
