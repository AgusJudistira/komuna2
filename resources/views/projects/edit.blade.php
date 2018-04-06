@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="post" action="/projects/save_existing/{{$project->id}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                <div class="form-group col-md-12 row" rel="popover" data-trigger="hover" data-content="De naam van de organisatie" data-original-title="">
                                    <label class="control-label control-label-right col-md-4 text-right" for="projectname">Projectnaam<span class="req"> *</span></label>
                                    <div class="controls col-md-8"> 
                                        <input id="projectname" name="name" value="{{ $project->name }}" class="form-control k-textbox" data-role="text" required="required" data-parsley-minwords="1" style="cursor: auto;" type="text">
                                    </div>
                                </div>
                            </h4>
                            <div class="col-md-12">
                                @if ($errors->has('projectname'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('projectname') }}</strong>
                                    </span>
                                @endif
                            </div>               
                        </div>
                        <div class="card-body">
                            <div class="form-group row" rel="popover" data-trigger="hover" data-content="Uitgebreide beschrijving van het project" data-original-title="">
                                <label class="control-label control-label-right col-md-4 text-right" for="projectdescription">Projectomschrijving</label>
                                <div class="controls col-md-8">                                        
                                    <textarea class="form-control" id="description" row="5" name="description" value="" class="form-control k-textbox" data-role="text" data-parsley-minwords="1" style="cursor: auto;" type="text">{{ $project->description }}</textarea>
                                </div>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>               

                            <div class="form-group row" rel="popover" data-trigger="hover" data-content="Startdatum van het project" data-original-title="">
                                <label class="control-label control-label-right col-md-4 text-right" for="start_date">Startdatum<span class="req"> *</span></label>
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
                                <label class="control-label control-label-right col-md-4 text-right" for="due_date">Geplande einddatum</label>

                                <div class="col-md-8">
                                    <p><input type="date" class="date form-control" id="due_date" name="due_date" value="{{\Carbon\Carbon::parse($project->due_date)->format('Y-m-d')}}" data-role="date" style="cursor: auto;"></p>
                                </div>

                                @if ($errors->has('due_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('due_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            
                            <div class="form-group row" rel="popover" data-trigger="hover" data-content="Genoeg leden" data-original-title="">
                                <label class="control-label control-label-right col-md-4 text-right">Heeft genoeg medewerkers:</label>
                                <div class="col-md-1">
                                    @if ($project->enough_members)
                                        <input type="checkbox" class="form-check-input form-control" name="enough_members" value="enough_members" checked>
                                    @else
                                        <input type="checkbox" class="form-check-input form-control" name="enough_members" value="enough_members">
                                    @endif
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    Markeer projectleden om ze <span class="text-danger">af te melden:</span>
                                    <div class="row">
                                        @foreach ($list_of_projectusers as $projectuser)
                                            @if (!$projectuser->pivot->projectowner)
                                                <div class="checkbox col-md-3">                                                
                                                    <label><input type="checkbox" name="deleted_projectmembers[]" value="{{$projectuser->id}}"> {{$projectuser->firstname . " " . $projectuser->lastname}}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    {{-- <h5>
                                    @foreach ($list_of_projectusers as $projectuser)
                                        @if ($projectuser->pivot->projectowner)
                                            <span class="badge badge-pill badge-info">{{ $projectuser->firstname . " " . $projectuser->lastname }} (eigenaar)</span>                                            
                                        @else
                                            <span class="badge badge-pill badge-secondary">{{ $projectuser->firstname . " " . $projectuser->lastname }}</span>
                                        @endif
                                    @endforeach
                                    </h5> --}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                </div>                                                                      
                                
                                <div class="col-md-3">                                    
                                    <button id="annuleren" name="annuleren" value="annuleren" type="submit" class="btn btn-info btn-lg">Annuleren</button>
                                </div>
                                <div class="col-md-4">                                    
                                    <button id="invoeren" name="invoeren" value="invoeren" type="submit" class="btn btn-primary btn-lg">Benodigde vaardigheden aangeven</button>
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