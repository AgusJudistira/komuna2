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
                    <form class="form-group mt-4" method="POST" action="/workExperience/update_workExperience">
                        {{csrf_field()}}
                            
                                <input id="user_id" type="text" class="form-control d-none" name="user_id" value="{{ Auth::guard('web')->user()->id}}" required>
                            
                        
                         <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Organisatie') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    
                        <!-- Start datum -->
                    
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
                        <!-- eind datum -->
                    
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
                        <!-- afdeling -->
                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Afdeling') }}</label>
                            <div class="col-md-6">
                                <input id="department" type="text" class="form-control" name="department" value="" required>
                                @if ($errors->has('department'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                          <!-- functie -->
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
                        <!-- job description -->
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('job description') }}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="description" rows="5"></textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ml-auto" role="button">
                            {{ __('Sla op') }}
                        </button> 
                    </form>
                
                <!-- Not in function right now -->
                <div class="d-none">
                    <!-- referentie  -->
                    <form class="form-group" method="POST" action="/">
                        <div class="card-header">  
                            <h5>Voeg referentie toe</h5>                      
                        </div>
                         <div class="form-group row mt-4">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Naam') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <!-- functie -->                    
                         <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Telefoonnummer') }}</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="" required>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                    
                     <!-- functie -->                    
                         <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
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

