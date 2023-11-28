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
            function CartItem() {
                const elDoc = $(document);

                function numberFormat(number) {
                    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                }
                function evChangeQtyOredered() {
                    let key = $(this).data('key');
                    let price = $(this).data('price');
                    let qtyOrderd = $(this).val();

                    const elSubtotal = $('#key-' + key);

                    let subtotal = price * qtyOrderd;

                    elSubtotal.text('Rp' + numberFormat(subtotal));
                    elSubtotal.attr('data-subtotal', subtotal);
                }

                elDoc.on('change', '[data-qty]', evChangeQtyOredered);
            }

            CartItem();
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
                {{-- <div class="cart-item">
                    <div class="row">
                        <div class="col-2">
                            <img src="{{ asset('assets/img/shop_01.jpg') }}">
                        </div>
                        <div class="col-4">
                            <h3 class="h3">Kemeja putih</h3>
                            <p>Deskripsi singkat mengenai produk tidak lebih dari 180 karakter mungkin.</p>
                        </div>
                        <div class="col-2">
                            <h3 class="h3">Harga</h3>
                            <p>Rp 10.000</p>
                        </div>
                        <div class="col-2">
                            <h3 class="h3">Jumlah</h3>
                            <input type="number" name="qty" value="1" style="width: 100%;">
                        </div>
                        <div class="col-2">
                            <h3 class="h3">Total</h3>
                            <p>Rp 10.000</p>
                        </div>
                    </div>
                </div> --}}
                @foreach($cartItems as $key => $cart)
                <div class="cart-item">
                    <div class="row">
                        <div class="col-2">
                            <img src="{{ asset('assets/img/shop_01.jpg') }}">
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
                            <input type="number" name="qty" value="{{ $cart->qty_ordered }}" style="width: 100%;" data-qty="" data-price="{{ $cart->product->price }}" data-key="{{ $key }}">
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
            <h3 class="h3">Alamat</h3>
            <textarea style="width: 100%;"></textarea>
            <hr>
            <div class="d-flex justify-content-between">
                <div>Sub total</div>
                <div class="text-end">Rp 10.000</div>
            </div>
            <div class="d-flex justify-content-between">
                <div>Biaya pengiriman</div>
                <div class="text-end">Rp 15.000</div>
            </div>
            <div class="d-flex justify-content-between">
                <div><h3 class="h3">Total</h3></div>
                <div class="text-end"><h3 class="h3">Rp 25.000</h3></div>
            </div>
            <a href="#" class="btn btn-success">Checkout</a>
        </div>
    </div>
</div>
<!-- End Contact -->
@endsection

