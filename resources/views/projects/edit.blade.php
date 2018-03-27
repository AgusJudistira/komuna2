@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <form method="post" action="/projects/save_existing/{{$project->id}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="card">
                        <div class="card-header">  
                            <div class="form-group row" rel="popover" data-trigger="hover" data-content="De naam van de organisatie" data-original-title="">
                                <h4 class="col-md-12">
                                    <label class="control-label control-label-left col-md-4" for="projectname">Projectnaam<span class="req"> *</span></label>
                                    <div class="controls col-md-12"> 
                                        <input id="projectname" name="name" value="{{ $project->name }}" class="form-control k-textbox" data-role="text" required="required" data-parsley-minwords="1" style="cursor: auto;" type="text"></h1>
                                    </div>
                                </h4>
                                @if ($errors->has('projectname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('projectname') }}</strong>
                                    </span>
                                @endif
                            </div>               
                        </div>
                        <div class="card-body">
                            <div class="form-group row" rel="popover" data-trigger="hover" data-content="Uitgebreide beschrijving van het project" data-original-title="">
                                <label class="control-label control-label-left col-md-4" for="projectdescription">Projectomschrijving<span class="req"> *</span></label>
                                <div class="controls col-md-8">                                        
                                    <textarea class="form-control" id="description" row="5" name="description" value="" class="form-control k-textbox" data-role="text" required="required" data-parsley-minwords="1" style="cursor: auto;" type="text">{{ $project->description }}</textarea>
                                </div>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>               

                            <div class="form-group row" rel="popover" data-trigger="hover" data-content="Startdatum van het project" data-original-title="">
                                <label class="control-label control-label-left col-md-4" for="start_date">Startdatum<span class="req"> *</span></label>
                                <div class="controls col-md-8">                                        
                                    {{--  <p><input id="start_date" name="start_date" value="{{\Carbon\Carbon::parse($project->start_date)->format('Y-m-d')}}" class="form-control k-textbox" data-role="date" required="required" data-parsley-minwords="1" style="cursor: auto;" type="date"></p>  --}}
                                    <p><input type="date" class="date form-control" id="start_date" name="start_date" value="{{\Carbon\Carbon::parse($project->start_date)->format('Y-m-d')}}" data-role="date" required="required" style="cursor: auto;"></p>
                                </div>

                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>        
                            
                            <div class="form-group row" rel="popover" data-trigger="hover" data-content="Geplande einddatum van het project" data-original-title="">
                                <label class="control-label control-label-left col-md-4" for="due_date">Geplande einddatum<span class="req"> *</span></label>
                                {{--  <div class="controls col-md-8">  --}}
                                <div class="col-md-8">
                                    {{--  <p>{!! Form::date('due_date', date($project->due_date), ['class' => 'form-control']) !!}</p>  --}}                                    
                                    <p><input type="date" class="date form-control" id="due_date" name="due_date" value="{{\Carbon\Carbon::parse($project->due_date)->format('Y-m-d')}}" data-role="date" style="cursor: auto;"></p>
                                    {{--  <p><input type="date" class="date form_control" id="due_date" name="due_date" value="{{\Carbon\Carbon::parse($project->due_date)->format('Y-m-d')}}" data-role="date" style="cursor: auto;"></p>  --}}
                                </div>

                                @if ($errors->has('due_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('due_date') }}</strong>
                                    </span>
                                @endif
                            </div>    
                            
                            <div class="row">
                                <div class="col-md-12">
                                    Projectleden:
                                    <ul>
                                        @foreach ($list_of_projectusers as $projectuser)
                                            <li>{{ $projectuser->firstname . " " . $projectuser->lastname }}
                                                @if ($projectuser->pivot->projectowner)
                                                    <span> (eigenaar)</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                </div>                                                                      
                                
                                <div class="col-md-3">                                    
                                    <button id="annuleren" name="annuleren" value="annuleren" type="submit" class="btn btn-info btn-lg">Annuleren</button>
                                </div>
                                <div class="col-md-3">                                    
                                    <button id="invoeren" name="invoeren" value="invoeren" type="submit" class="btn btn-primary btn-lg">Invoeren</button>
                                </div>                                    
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>                            
    </div>
</div>   
@endsection