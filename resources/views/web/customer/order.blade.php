@extends('web.layouts.base')

@section('title', 'Order')

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
                        <h2 class="h2">Order</h2>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>No Invoice</th>
                                    <th>Amount total</th>
                                    <th>Shipment address</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Upload payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderList as $order)
                                <tr>
                                    @php
                                        $status = '';

                                        switch($order->status) {
                                            case 'N':
                                                $status = 'Baru';
                                            break;
                                            case 'S':
                                                $status = 'Pengiriman';
                                            break;
                                            case 'D':
                                                $status = 'Selesai';
                                            break;
                                            case 'C':
                                                $status = 'Batal';
                                            break;
                                        }
                                    @endphp
                                    <td>{{ $order->no_invoice }}</td>
                                    <td>{{ $order->amount_total }}</td>
                                    <td>{{ $order->shipment_address }}</td>
                                    <td>{{ $status }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td><a href="{{ route('web.customer.uplad_form', ['id' => $order->id]) }}">Upload</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection