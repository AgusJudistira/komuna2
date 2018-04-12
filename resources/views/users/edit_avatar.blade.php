@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header">{{ __('Kies een avatar') }}</h4>
                <div class="card-body">
                    <div class="row">
                        <!-- select image -->
                        <div class="col-md-4">
                            <img class="rounded float-left" src="/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 25px; margin-right:  250px;">
                            <form id='form' method="POST" action="{{route('users.update_avatar', $user)}}" enctype="multipart/form-data">
                                <input id="avatar_upload" type="file" name="avatar" onchange="javascript:document.getElementById('form').submit();" value="kies avatar">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group row">
                                    @if ($errors->has('avatar'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer col-md-12">
                    <div class="row">
                        <!-- back to personal -->
                        <div class="col-md-12">
                            <div class="col-md-6 float-left">
                                <form class="float-left" method="GET" action="/users/{{Auth::user()->id}}/edit_personal"> 
                                    <button type="submit" class="btn btn-primary " role="button">
                                        {{ __('Vorige') }}
                                    </button> 
                                </form>
                            </div>
                            <div class="col-md-6 float-right">
                                <!--Forward to description --> 
                                <form class="float-right" method="GET" action="/users/{{Auth::user()->id}}/edit_description"> 
                                
                                    <button type="submit" class="btn btn-primary " role="button">
                                    {{ __('Volgende') }}
                                    </button> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
