@extends('web.layouts.base')

@section('title', 'Shop Single')

@section('script')
    <script>
        $(document).ready(function() {
            function ProductOrder() {
                let elBtnPlus = $('#product_qty_btn_plus');
                let elBtnMinus = $('#product_qty_btn_minus');
                let elQtyValue = $('#product_qty_value');
                let elUrlLink = $('#product_qty_add_cart_url');

                let qtyOrdered = 1;

                function fnUrl() {
                    let url = new URL('{{ route('action.cart_add') }}');

                    url.searchParams.set('product_id', {{ $product->id }});
                    url.searchParams.set('qty_ordered', qtyOrdered);

                    elUrlLink.attr('href', url.href);
                }
                function evClickButtonPlus() {
                    qtyOrdered += 1;

                    elQtyValue.text(qtyOrdered);
                    fnUrl()
                }
                function evClickButtonMinus() {
                    if((qtyOrdered - 1) == 0) {
                        return;
                    }

                    qtyOrdered -= 1;

                    elQtyValue.text(qtyOrdered);
                    fnUrl();
                }

                elBtnPlus.on('click', evClickButtonPlus);
                elBtnMinus.on('click', evClickButtonMinus);
            }

            ProductOrder();
        });
    </script>
@endsection

@section('content')
<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">
        @if(Session::has('fail_cart_add'))
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger mt-4">
                    {{ Session::get('fail_cart_add') }}
                    @php
                    Session::forget('fail_cart_add');
                    @endphp
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="{{ url('storage/' . $product->featured_image) }}" alt="Card image cap" id="product-detail">
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2">{{ $product->name }}</h1>
                        <p class="h3 py-2">Rp{{ number_format($product->price, 2, '.', ',') }}</p>

                        <h6>Description:</h6>
                        <p>{{ $product->description }}</p>

                        <div>
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">
                                            Quantity
                                            <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                        </li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="product_qty_btn_minus">-</span></li>
                                        <li class="list-inline-item"><span class="badge bg-secondary" id="product_qty_value">1</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="product_qty_btn_plus">+</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <a href="{{ route('action.cart_add', ['product_id' => $product->id, 'qty_ordered' => 1]) }}" class="btn btn-success btn-lg" id="product_qty_add_cart_url">Add To Cart</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Close Content -->
@endsection
