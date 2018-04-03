@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group">
                <div class="card">

                    <div class="card-header">  
                        <h4>Voeg vaardigheid toe</h4>                      
                    </div>
                    <!-- Organization -->
                    <form class="form-group mt-4" method="POST" action="{{route('users.store_skills', $user)}}">
                        {{csrf_field()}}                   
                            
                         <div class="form-group row">
                            <label for="skill" class="col-md-4 col-form-label text-md-right">{{ __('Voeg een vaardigheid toe') }}</label>
                            <div class="col-md-6">
                                <input id="skill" type="text" class="form-control" name="skill" required>
                                @if ($errors->has('skill'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @foreach($skills as $skill)
                            {{$skill->skill}}
                        @endforeach


                    
                         <button type="submit" class="btn btn-primary ml-auto float-right" role="button">
                            {{ __('Sla op') }}
                        </button> 
                    </form>
                    

                    <!-- Terug naar competenties -->
                    <form class="col-md-2 float-left" method="GET" action="/users/{{Auth::user()->id}}/edit_competences"> 
                        <button type="submit" class="btn btn-primary ml-auto" role="button">
                            {{ __('Vorige') }}
                        </button> 
                    </form>
                   <!--  Naar volgende -->  
                    <form class="col-md-2 float-right" method="GET" action="/users/{{Auth::user()->id}}/edit_workExperience"> 
                         <button type="submit" class="btn btn-primary ml-auto" role="button">
                             {{ __('Volgende') }}
                         </button> 
                  

                    


                 </div>
             </div>
         </div>
     </div>
 </div>

@endsection