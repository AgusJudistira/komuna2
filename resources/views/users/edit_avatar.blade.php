@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('kies een avatar') }}
                </div>
                <div class="card-body">
                    <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-2">
                        <!-- geselecteerde afbeelding -->
                        <img class="rounded float-left" src="/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 25px; margin-right:  250px;">
                        <!-- Afbeelding selectie -->
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
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-10">
                                    <!-- Terug naar NAW-gegevens -->
                                    <form class="col-md-2 float-left" method="GET" action="/users/{{Auth::user()->id}}/"> 
                                        <button type="submit" class="btn btn-primary ml-auto" role="button">
                                            {{ __('Vorige') }}
                                        </button> 
                                    </form>
                                    <!-- Naar competenitei selectie --> 
                                    <form class="col-md-2 float-right" method="GET" action="/users/{{Auth::user()->id}}/edit_competences"> 
                                    <button type="submit" class="btn btn-primary ml-auto" role="button">
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
</div>
@endsection
