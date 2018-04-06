@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-group">
                <div class="card">

                    <div class="card-header">  
                        <h4>Voeg vaardigheden toe voor project <b>{{$project->name}}</b></h4>
                    </div>

                    <div class="card-body">  
                        <form class="form-group float-left ml-1" method="POST" action="{{route('projects.detach_skills', $project)}}">
                            @foreach ($skills_selected as $skill_selected)
                            {{csrf_field()}}
                            <button type="submit" name='skill' value='{{ $skill_selected->id }}' data-toggle="tooltip" class="btn btn-default float-left ml-1 mb-1" >{{ $skill_selected->skill }}</button>
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
                        <form class="form-group col-md-12" method="POST" action="{{route('projects.store_skills', $project)}}">
                            {{csrf_field()}}
                                
                            <div class="form-group col-md-12 row">
                                <label for="skill" class="col-md-3 col-form-label text-md-right">{{ __('Voeg een vaardigheid toe') }}</label>
                                <div class="col-md-7">
                                    <input list="skills" id="skill" type="text" class="form-control" name="skill" required>
                                        <datalist id="skills"> 
                                            @foreach($skills as $skill)
                                                <option>{{$skill->skill}}</option>
                                            @endforeach
                                        </datalist>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary ml-auto float-left" role="button">
                                        {{ __('Sla op') }}
                                    </button> 
                                </div>

                                @if ($errors->has('skill'))
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
                            <form class="col-md-2 float-left" method="POST" action="{{ route('project_edit', $project) }}"> 
                                {{csrf_field()}}
                                <button type="submit" class="btn btn-primary ml-auto" role="button">
                                    {{ __('Vorige') }}
                                </button> 
                            </form>
                        <!--  Naar competenties -->  
                            <form class="col-md-2 float-right" method="GET" action="/projects/{{$project->id}}/edit_competences"> 
                                {{csrf_field()}}
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