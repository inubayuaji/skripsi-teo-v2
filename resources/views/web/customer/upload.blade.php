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
                @if(session()->has('message'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('message') }}
                </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <h2 class="h2">Upload payment</h2>
                        
                        <form class="col-md-5" method="post" role="form" action="{{ route('web.customer.uplad_form', ['id' => $orderId]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="file" class="form-control mt-1" name="payment_proof" accept="image/*" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-start mt-2 mb-3">
                                    <button type="submit" class="btn btn-success">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection