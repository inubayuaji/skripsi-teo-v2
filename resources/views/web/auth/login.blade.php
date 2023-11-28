@extends('web.layouts.base')

@section('title', 'Login Member')

@section('content')
<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Login Member</h1>
        <p>
            Login dulu untuk melakukan belanja.
        </p>
    </div>
</div>

<!-- Start Contact -->
<div class="container py-5">
    <div class="row py-5">
        @if(Session::has('success_create_costumer'))
        <div class="alert alert-success col-md-9 m-auto mb-4">
            {{ Session::get('success_create_costumer') }}
            @php
            Session::forget('success_create_costumer');
            @endphp
        </div>
        @endif
        <form class="col-md-5 m-auto" method="post" role="form" action="{{ route('action.login_customer') }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-12 mb-3">
                    <label for="phone_number">No telepon</label>
                    <input type="text" class="form-control mt-1" id="phone_number" name="phone_number" placeholder="085xxxxxxx" required>
                </div>
                <div class="form-group col-md-12 mb-3">
                    <label for="password">password</label>
                    <input type="password" class="form-control mt-1" id="password" name="password" required>
                </div>
            </div>
            <div class="row">
                <div class="col text-center mt-2 mb-3">
                    <button type="submit" class="btn btn-success btn-lg px-3">Login</button>
                </div>

                <p class="text-center text-sm">Belum punya akun, <a href="{{ route('web.auth.register') }}">daftar akun baru.</a></p>
            </div>
        </form>
    </div>
</div>
<!-- End Contact -->
@endsection

