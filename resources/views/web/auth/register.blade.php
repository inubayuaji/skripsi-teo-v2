@extends('web.layouts.base')

@section('title', 'Login Member')

@section('content')
<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Daftar Member</h1>
        <p>
            Buat akun member untuk melakukan transaksi.
        </p>
    </div>
</div>

<!-- Start Contact -->
<div class="container py-5">
    <div class="row py-5">
        @if(Session::has('fail_create_costumer'))
        <div class="alert alert-danger col-md-9 m-auto mb-4">
            {{ Session::get('fail_create_costumer') }}
            @php
            Session::forget('fail_create_costumer');
            @endphp
        </div>
        @endif
        <form class="col-md-5 m-auto" method="post" role="form" action="{{ route('action.register_customer') }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-12 mb-3">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control mt-1" id="name" name="name" required>
                </div>
                <div class="form-group col-md-12 mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control mt-1" id="email" name="email" required>
                </div>
                <div class="form-group col-md-12 mb-3">
                    <label for="phone_number">No telepon</label>
                    <input type="text" class="form-control mt-1" id="phone_number" name="phone_number" placeholder="085xxxxxxx" required>
                </div>
                <div class="form-group col-md-12 mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control mt-1" id="password" name="password" required>
                </div>
                <div class="form-group col-md-12 mb-3">
                    <label for="retype_password">Ketik ulang password</label>
                    <input type="password" class="form-control mt-1" id="retype_password" name="retype_password" required>
                </div>
            </div>
            <div class="row">
                <div class="col text-center mt-2 mb-3">
                    <button type="submit" class="btn btn-success btn-lg px-3">Daftar</button>
                </div>

                <p class="text-center text-sm">Sudah punya akun, <a href="{{ route('web.auth.login') }}">login akun.</a></p>
            </div>
        </form>
    </div>
</div>
<!-- End Contact -->
@endsection

