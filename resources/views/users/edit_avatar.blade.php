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
                                <img class="rounded float-left" src="/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 25px; margin-right:  250px;">
                                <form id='form' method="POST" action="{{route('users.update_avatar', $user)}}" enctype="multipart/form-data">
                                    <!-- <label for="avatar_upload" class="btn btn-primary ml-auto">kies avatar</label> -->
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
                                    <!-- <input type="submit" class="pull-right btn btn-sm btn-primary"> -->
                            </div>
                        </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-10">
                            
                            <form method="GET" action="{{route('users.update_competences', $user)}}">
                                <button type="submit" class="btn btn-primary ml-auto">
                                    {{ __('Next') }}
                                </button> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection