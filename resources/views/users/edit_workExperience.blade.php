@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group">
                <div class="card">
                    <div class="card-header">  
                        <h4>Voeg werkervaring toe</h4>                      
                    </div>
                    <!-- Organization -->
                    <form class="form-group mt-4" method="POST" action="/">
                         <div class="form-group row">
                            <label for="organization" class="col-md-4 col-form-label text-md-right">{{ __('Organisatie') }}</label>
                            <div class="col-md-6">
                                <input id="organization" type="text" class="form-control{{ $errors->has('organization') ? ' is-invalid' : '' }}" name="organization" value="" required>
                                @if ($errors->has('organization'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('organization') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                    <!-- Start datum -->
                    <form class="form-group" method="POST" action="/">
                         <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('start datum') }}</label>
                            <div class="col-md-6">
                                <input id="start_date" type="date" class="form-control" name="start_date" value="" required>
                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form><!-- eind datum -->
                    <form class="form-group" method="POST" action="/">
                         <div class="form-group row">
                            <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('eind datum') }}</label>
                            <div class="col-md-6">
                                <input id="end_date" type="date" class="form-control" name="end_date" value="" required>
                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                    <!-- functie -->
                    <form class="form-group" method="POST" action="/">
                         <div class="form-group row">
                            <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Functie') }}</label>
                            <div class="col-md-6">
                                <input id="position" type="text" class="form-control" name="position" value="" required>
                                @if ($errors->has('position'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                    <!-- job description -->
                    <form class="form-group" method="POST" action="/">
                         <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('job description') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" rows="5"></textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                    <!-- Terug naar competenties -->
                    <form class="col-md-2 float-right" method="GET" action="/users/{{Auth::user()->id}}/edit_competences"> 
                        <button type="submit" class="btn btn-primary ml-auto" role="button">
                            {{ __('Vorige') }}
                        </button> 
                    </form>
      
                    <!-- Naar volgende
                    <form class="col-md-2 float-right" method="GET" action="/users/{{Auth::user()->id}}/edit_workExperience"> 
                         <button type="submit" class="btn btn-primary ml-auto" role="button">
                             {{ __('Volgende') }}
                         </button> 
                    </form>  -->   
                 </div>
             </div>
         </div>
     </div>
 </div>

        @endsection

