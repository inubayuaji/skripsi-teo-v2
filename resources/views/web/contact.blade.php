@extends('web.layouts.base')

@section('title', 'Contact')

@section('style')
<!-- Load map styles -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script>
    var mymap = L.map('mapid').setView([-23.013104, -43.394365, 13], 13);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18
        , attribution: 'Zay Telmplte | Template Design by <a href="https://templatemo.com/">Templatemo</a> | Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>'
        , id: 'mapbox/streets-v11'
        , tileSize: 512
        , zoomOffset: -1
    }).addTo(mymap);

    L.marker([-23.013104, -43.394365, 13]).addTo(mymap)
        .bindPopup("<b>Zay</b> eCommerce Template<br />Location.").openPopup();

    mymap.scrollWheelZoom.disable();
    mymap.touchZoom.disable();

</script>
@endsection

@section('content')
<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Contact Us</h1>
        <p>
            Proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            Lorem ipsum dolor sit amet.
        </p>
    </div>
</div>

<!-- Start Map -->
<div id="mapid" style="width: 100%; height: 300px;"></div>
<!-- Ena Map -->

<!-- Start Contact -->
<div class="container py-5">
    <div class="row py-5">
        @if(Session::has('success'))
        <div class="alert alert-success col-md-9 m-auto mb-4">
            {{ Session::get('success') }}
            @php
            Session::forget('success');
            @endphp
        </div>
        @endif

        <form class="col-md-9 m-auto" method="post" role="form" action="{{ route('action.store_contact_form') }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="phone_number">Phone</label>
                    <input type="text" class="form-control mt-1" id="phone_number" name="phone_number" placeholder="085xxxxxxx">
                    @if ($errors->has('phone_number'))
                        <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                    @endif
                </div>
            </div>
            <div class="mb-3">
                <label for="messages">Messages</label>
                <textarea class="form-control mt-1" id="messages" name="messages" placeholder="Messages" rows="8"></textarea>
                @if ($errors->has('messages'))
                    <span class="text-danger">{{ $errors->first('messages') }}</span>
                @endif
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" class="btn btn-success btn-lg px-3">Let’s Talk</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Contact -->
@endsection
