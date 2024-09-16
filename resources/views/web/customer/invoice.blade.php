@extends('web.layouts.base')

@section('title', 'Invoice')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('print.min.css') }}">
@endsection

@section('script')
<script src="{{ asset('print.min.js') }}"></script>
@endsection

@section('content')
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-3 mt-5">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('web.customer.profil') }}">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('web.customer.order') }}">Order</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('action.logout_customer') }}">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div id="print-area">
                            <div class="row">
                                <div class="col-6">
                                    <h2 class="h2">{{ $order->customer->name }}</h2>
                                </div>
                                <div class="col-6">
                                    <h2 class="h2 text-end">Invoice</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>{{ $order->shipment_address }}<br />{{ $order->subdistrict }}</p>
                                </div>
                                <div class="col-6">
                                    <p class="text-end">No {{ $order->no_invoice }}<br />{{ $order->created_at->format('Y/m/d') }}</p>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Qty</th>
                                                <th>Deskripsi</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->lines as $line)
                                            <tr>
                                                <td>{{ $line->quantity }}</td>
                                                <td>{{ $line->product->name }}</td>
                                                <td class="text-end">{{ $line->price }}</td>
                                                <td class="text-end">{{ $line->amount_total }}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td>1</td>
                                                <td>Ongkir</td>
                                                <td class="text-end">15000</td>
                                                <td class="text-end">15000</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3">Total</td>
                                                <td class="text-end">{{ $order->amount_total + $order->shipment_total }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <button type="button" class="btn btn-success" onclick="printJS({printable: 'print-area', type: 'html', scanStyles: false})">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection