@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <h4 class="card-header">Organizatie-overzicht</h4>

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
            <form style="z-index: 3; position: fixed; bottom: 30px; right: 30px;" action="{{ route('org.inputform') }}" method="post" role="form">
                {{ csrf_field() }}
                <button id="create_orgnization" name="create_orgnization" value="create_orgnization" type="create_orgnization" class="btn btn-info btn-lg">Nieuwe oranisatie aanmaken</button>
            </form>
            {{--  <div class="card-footer"><h5><a href="{{ route('org.inputform') }}">Nieuwe organisatie aanmaken</a></h5></div>  --}}
        </div>
    </div>
</div>
@endsection
