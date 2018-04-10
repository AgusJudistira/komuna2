@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('iets over jezelf') }}</div>
                <!-- NAW Form -->
                <div class="card-body">
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
                                <button type="submit" class="btn btn-success ml-auto">
                                    {{ __('opslaan') }}
                                </button>

                    </form>


                                 
                      
                                </div>
                            </div>
                        <div class="card-footer">
                            <!-- Terug naar avatar -->
                            <div class="card-footer">
                                <div class="col-md-12">
                                    <form class="col-md-2 float-left" method="GET" action="/users/{{Auth::user()->  id}}/edit_avatar"> 
                                        <button type="submit" class="btn btn-primary ml-auto" role="button">
                                    {{ __('Vorige') }}
                                        </button> 
                                    </form>
                        <!--  Naar volgende -->  
                                    <form class="col-md-2 float-right" method="GET" action="/users/{{Auth::user()->id}}/edit_hobbies">
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
@endsection
