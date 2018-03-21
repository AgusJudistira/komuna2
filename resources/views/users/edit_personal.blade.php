@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('personelijke gegevens') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('users.update', $user)}}">
                        @csrf
                        {{ method_field('patch') }}
                        

                            <div class="form-group row ">
                                <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('Geboorte datum') }}</label>

                                <div class="col-md-6">
                                <input id="birthday" type="date" class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}" name="birthday" value="{{ Auth::guard('web')->user()->birthday }}" required autofocus>

                                @if ($errors->has('birthday'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                                </div>


                            </div>
                        
                         <div class="form-group row ">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6 ">
                                <select id="gender" type="text" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ $user->gender }}" required>
                                    <option selected>{{ Auth::guard('web')->user()->gender }} </option>
                                    <option>Man</option>
                                    <option>Vrouw</option>

                                </select>
                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="streetname_number" class="col-md-4 col-form-label text-md-right">{{ __('Straatnaam en nummer') }}</label>

                            <div class="col-md-6">
                                <input id="streetname_number" type="text" class="form-control{{ $errors->has('streetname_number') ? ' is-invalid' : '' }}" name="streetname_number" value="{{ $user->streetname_number }}" required>

                                @if ($errors->has('streetname_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('streetname_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                            <div class="col-md-6">
                                <input id="postal_code" type="text" class="form-control{{ $errors->has('postal_code') ? ' is-invalid' : '' }}" name="postal_code" value="{{ $user->postal_code }}" required>

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
                                <input id="city" type="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ $user->city }}" required>

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
                                <input id="phone_private" type="text" class="form-control{{ $errors->has('phone_private') ? ' is-invalid' : '' }}" name="phone_private" value="{{  $user->phone_private }}" required>

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
                                <input id="phone_work" type="text" class="form-control{{ $errors->has('phone_work') ? ' is-invalid' : '' }}" name="phone_work" value="{{ $user->phone_work }}" required>

                                @if ($errors->has('phone_work'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone_work') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-10">
                                <button type="submit" class="btn btn-primary ml-auto">
                                    {{ __('Next') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
