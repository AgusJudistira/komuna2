@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <h4 class="card-header col-md-6">Organizatie-overzicht<span class="col-md-8 pull-right"><a href="{{ route('org.inputform') }}">Nieuwe organisatie aanmaken</a></span></h4>

                <div class="card-body">

                    <div class="row">
                        <h5 class="col-md-3">Organisatie</h5>
                        <h5 class="col-md-3">Adres</h5>
                        <h5 class="col-md-3">Postcode</h5>
                        <h5 class="col-md-3">Vestigingsplaats</h5>
                        @foreach ($org_list as $org)
                            <div class="col-md-3">{{ $org->name }}</div>
                            <div class="col-md-3">{{ $org->streetname_number }}</div>
                            <div class="col-md-3">{{ $org->postal_code }}</div>
                            <div class="col-md-3">{{$org->city }}</div>
                        @endforeach
                    </div>
                    {{--  You are logged in as {{ Auth::guard('web')->user()->firstname . " ". Auth::guard('web')->user()->lastname}}  --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
