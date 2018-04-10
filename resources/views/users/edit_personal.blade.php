@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h4 class="card-header">{{ __('Persoonlijke gegevens') }}</h4>
                <!-- NAW Form -->
                <form method="POST" action="{{route('users.update', $user)}}">
                    @csrf
                    <div class="card-body">                                            
                        {{ method_field('patch') }}
                        <!-- Geboorte datum -->
                        <div class="form-group row ">
                            <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('Geboorte datum') }}</label><div class="col-md-6">
                            <input id="birthday" type="date" class="form-control" name="birthday" value="{{ Auth::guard('web')->user()->birthday }}" autofocus required>
                                @if ($errors->has('birthday'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <!-- Geslacht -->
                         <div class="form-group row ">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Geslacht') }}</label>
                            <div class="col-md-6 ">
                                <select id="gender" type="text" class="form-control" name="gender" value="{{ $user->gender }}" >
                                    <option selected>{{ Auth::guard('web')->user()->gender }} </option>
                                    <option>Man</option>
                                    <option>Vrouw</option>
                                    <option>Onzijdig</option>
                                </select>
                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- Straatnaam en Nummer -->
                        <div class="form-group row">
                            <label for="streetname_number" class="col-md-4 col-form-label text-md-right">{{ __('Straatnaam en nummer') }}</label>
                            <div class="col-md-6">
                                <input id="streetname_number" type="text" class="form-control" name="streetname_number" value="{{ $user->streetname_number }}" >
                                @if ($errors->has('streetname_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('streetname_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- Postcode -->
                        <div class="form-group row">
                            <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>
                            <div class="col-md-6">
                                <input id="postal_code" type="text" class="form-control" name="postal_code" value="{{ $user->postal_code }}" >
                                @if ($errors->has('postal_code'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Woonplaats') }}</label>
                            <div class="col-md-6">
                                <input id="city" type="city" class="form-control" name="city" value="{{ $user->city }}" required>

                                @if ($errors->has('city'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="phone_private" class="col-md-4 col-form-label text-md-right">{{ __('Telefoonnummer') }}</label>

                            <div class="col-md-6">
                                <input id="phone_private" type="text" class="form-control" name="phone_private" value="{{  $user->phone_private }}">

                                @if ($errors->has('phone_private'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone_private') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_work" class="col-md-4 col-form-label text-md-right">{{ __('Telefoonnummer werk') }}</label>

                            <div class="col-md-6">
                                <input id="phone_work" type="text" class="form-control" name="phone_work" value="{{ $user->phone_work }}">

                                @if ($errors->has('phone_work'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone_work') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group col-md-12 row">
                            <button type="submit" class="btn btn-primary ml-auto float-right">
                                {{ __('volgende') }}
                            </button>
                        </div>
                    </div>
                        
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
