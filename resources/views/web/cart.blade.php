@extends('web.layouts.base')

@section('title', 'Cart')

@section('style')
    <style>
        .cart-items {
        }
        .cart-item {
            padding: 18px 0 18px 0px;
            border-top: solid 1px #ccc;
        }
        .cart-item:last-child {
            border-bottom: solid 1px #ccc;
        }
        .cart-item img {
            width: 100%;
        }
    </style>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var state = {
                cartItemSubtotals: {}
            }

            function numberFormat(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function CartItem() {
                const elDoc = $(document);

                function fnUpdateQtyOrderd(productId, qtyOrdered) {
                    $.ajax({
                        type: 'get',
                        url: '{{ route('action.cart_update') }}',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'product_id': productId,
                            'qty_ordered': qtyOrdered
                        }
                    });
                }
                function evChangeQtyOredered() {
                    let key = $(this).data('key');
                    let price = $(this).data('price');
                    let qtyOrderd = $(this).val();
                    let productId = $(this).data('product-id');

                    const elSubtotal = $('#key-' + key);

                    let subtotal = price * qtyOrderd;
                    state.cartItemSubtotals[key] = subtotal

                    fnUpdateQtyOrderd(productId, qtyOrderd);

                    elSubtotal.text('Rp' + numberFormat(subtotal));
                    elSubtotal.attr('data-subtotal', subtotal);

                    elDoc.trigger('cart_item_update');
                }

                elDoc.on('change', '[data-qty]', evChangeQtyOredered);
                elDoc.trigger('cart_item_update');
            }

            function ChekcoutInfo() {
                const elDoc = $(document);
                const elTotal = $('#chekcout_info_total');
                const elSubtotal = $('#chekcout_info_subtotal');

                function evUpdateCartItem() {
                    let total = 0;
                    let subtotal = 0;

                    for(let key in state.cartItemSubtotals) {
                        if(state.cartItemSubtotals.hasOwnProperty(key)) {
                            subtotal += state.cartItemSubtotals[key];
                        }
                    }

                    total = subtotal + 15000; // default ongkir;

                    elTotal.text('Rp' + numberFormat(total));
                    elSubtotal.text('Rp' + numberFormat(subtotal));
                }

                elDoc.on('cart_item_update', evUpdateCartItem);
            }

            CartItem();
            ChekcoutInfo();
        });
    </script>
@endsection

@section('content')
<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Cart</h1>
        <p>
            Segera checkout barang anda.
        </p>
    </div>
</div>

<!-- Start Contact -->
<div class="container py-5">
    <div class="row">
        <div class="col-12 col-md-9">
            <div class="cart-items">
                @foreach($cartItems as $key => $cart)
                <div class="cart-item">
                    <div class="row">
                        <div class="col-2" style="position: relative;">
                            <img src="{{ url('storage/' . $cart->product->featured_image) }}">
                            <a href="{{ route('action.cart_delete', ['product_id' => $cart->product_id]) }}" class="btn btn-danger btn-sm" style="position: absolute; top: -10px; left: 5px;">x</a>
                        </div>
                        <div class="col-4">
                            <h3 class="h3">{{ $cart->product->name }}</h3>
                            <p>{{ Str::limit($cart->product->description, 180) }}</p>
                        </div>
                        <div class="col-2">
                            <h3 class="h3">Harga</h3>
                            <p>Rp{{ number_format($cart->product->price, 0, '.', '.') }}</p>
                        </div>
                        <div class="col-2">
                            <h3 class="h3">Jumlah</h3>
                            <input
                                type="number"
                                name="qty"
                                value="{{ $cart->qty_ordered }}"
                                style="width: 100%;"
                                data-qty=""
                                data-price="{{ $cart->product->price }}"
                                data-key="{{ $key }}"
                                data-product-id="{{ $cart->product_id }}"
                            >
                        </div>
                        <div class="col-2">
                            <h3 class="h3">Sub total</h3>
                            <p class="subtotal" id="key-{{ $key }}" data-subtotal="{{ $cart->qty_ordered * $cart->product->price }}">Rp{{ number_format($cart->qty_ordered * $cart->product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-12 col-md-3">
            <form method="post" action="{{ route('action.cakeout') }}">
                @csrf
                <h3 class="h3">Alamat</h3>
                <textarea style="width: 100%;" name="shipment_address" required></textarea>
                <hr>
                <div class="d-flex justify-content-between">
                    <div>Sub total</div>
                    <div class="text-end" id="chekcout_info_subtotal">Rp{{ number_format($subtotals, 2, '.', ',') }}</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>Biaya pengiriman</div>
                    <div class="text-end">Rp 15.000</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div><h3 class="h3">Total</h3></div>
                    <div class="text-end"><h3 class="h3" id="chekcout_info_total">Rp{{ number_format($subtotals + 15000, 2, '.', ',') }}</h3></div>
                </div>
                <button type="submit" class="btn btn-success">Checkout</button>
            </form>
        </div>
    </div>
</div>
<!-- End Contact -->
@endsection

