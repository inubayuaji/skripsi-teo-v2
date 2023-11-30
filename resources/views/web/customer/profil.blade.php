@extends('web.layouts.base')

@section('title', 'Profil')

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
                            <h2 class="h2">Profil</h2>
                            <p>Nama: {{ $profil->name }}</p>
                            <p>Nama: {{ $profil->email }}</p>
                            <p>Nama: {{ $profil->phone_number }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
