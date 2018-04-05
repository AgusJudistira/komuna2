@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-group">
                <div class="card">

                    <div class="card-header">  
                        <h4>Voeg competenties toe voor project <b>{{$project->name}}</b></h4>
                    </div>

                    <div class="card-body">
                        <form class="form-group float-left md-12" method="POST" action="{{route('projects.detach_competences', $project)}}">
                            @foreach ($competences_selected as $competence_selected)
                                {{csrf_field()}}
                            <button type="submit" name='competence' value='{{ $competence_selected->id }}' data-toggle="tooltip" class="btn btn-default float-left ml-1 mb-1" >{{ $competence_selected->competence }}</button>
                            @endforeach
                        </form>

                        <div class="form-group">
                            @if(count($errors))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error) 
                                    <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div >

                        <!-- voeg een vardigheid toe -->
                        <form class="form-group col-md-12" method="POST" action="{{route('projects.update_competences', $project)}}">
                            {{csrf_field()}}                   
                                
                            <div class="form-group col-md-12 row">
                                <label for="competence" class="col-md-3 col-form-label text-md-right">{{ __('Voeg een competentie toe') }}</label>
                                <div class="form-group">
                                    <select name="competences_select[]" class="form-control" size="12" multiple>
                                        @foreach ($competences as $competence)
                                            <option name='competence' value='{{ $competence->id }}' data-toggle="tooltip" title="{{ $competence->description }}" >{{ $competence->competence }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-default">Voeg toe</button>
                                </div>
                                {{-- <div class="col-md-7">
                                    <input list="competences" id="competence" type="text" class="form-control" name="competence" required>
                                    <datalist id="competences"> 
                                        @foreach($competences as $competence)
                                            <option>{{$competence->competence}}</option>
                                        @endforeach
                                    </datalist>
                                </div> --}}

                                {{-- <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary ml-auto float-left" role="button">
                                        {{ __('Sla op') }}
                                    </button> 
                                </div> --}}

                                @if ($errors->has('competence'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                
                            </div>

                        </form>
                    </div>
                    
                    <div class="card-footer">
                     <!-- Terug naar projects -->
                        <div class="col-md-12">
                            <form class="col-md-2 float-left" method="GET" action="/projects/{{$project->id}}/edit_skills"> 
                                <button type="submit" class="btn btn-primary ml-auto" role="button">
                                    {{ __('Vorige') }}
                                </button> 
                            </form>
                        <!--  Naar competenties -->  
                            <form class="col-md-2 float-right" method="GET" action="/projects/{{$project->id}}"> 
                                <button type="submit" class="btn btn-primary ml-auto" role="button">
                                    {{ __('Afronden') }}
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