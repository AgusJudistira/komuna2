@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('kies een avatar') }}
                </div>

                <div class="card-body">
                    <div class="row">
                    <div class="col-md-4">
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
                    </div>
                    <div class="col-md-8">
                        

                    <form method="POST" action="{{route('users.update_description', $user)}}">
                        @csrf
                        {{ method_field('patch') }}
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Vertel iets over jezelf') }}</label>
                            <div class="col-md-6">
                                <textarea rows="7" id="description" type="text" class="form-control" name="description" >{{ $user->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-10">
                                <button type="submit" class="btn btn-primary ml-auto">
                                    {{ __('opslaan') }}
                                </button>
                            </div>
                        <div>
                    </form>
                        <div class="card-footer">
                            <div class="col-md-12 row">
                            <!-- Terug naar NAW-gegevens -->
                            <div class="col-md-6 float-left">
                                <form class="float-left" method="GET" action="/users/{{Auth::user()->id}}/edit_personal"> 
                                    <button type="submit" class="btn btn-primary " role="button">
                                        {{ __('Vorige') }}
                                    </button> 
                                </form>
                            </div>
                            <div class="col-md-6 float-left">
                                <!-- Naar competenitei selectie --> 
                                <form class="float-right" method="GET" action="/users/{{Auth::user()->id}}/edit_hobbies"> 
                                
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
</div>
@endsection
