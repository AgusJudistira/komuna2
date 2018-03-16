@extends('layouts.app')

@section('content')

@include('layouts.errors')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Login') }}</div>
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email:') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>

                            @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Wachtwoord:') }}</label>
                            <div class="col-md-6">                                                            
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Inloggen</button>
                            <div class="col-md-6 offset-md-4">
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
