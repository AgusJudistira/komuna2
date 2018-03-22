@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('kies een avatar') }}</div>
                    <div class="card-body">
                       <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-2">
                                
                                <form id='form' method="POST" action="{{route('users.update_competences', $user)}}" enctype="multipart/form-data">
                                   <div class="col-md-6">
                                    <input id="city" type="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value= "{{ $user->city }}" required>
    
                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                            </div>
                                </form>
                                    <!-- <input type="submit" class="pull-right btn btn-sm btn-primary"> -->
                            </div>
                        </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-10">
                            <button type="submit" class="btn btn-primary ml-auto">
                                {{ __('volgende') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
