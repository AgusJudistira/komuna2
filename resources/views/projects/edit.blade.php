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
                                <div class="form-group col-md-12 mt-3 row" rel="popover" data-trigger="hover" data-content="De naam van de organisatie" data-original-title="">
                                    <label class="control-label control-label-right col-md-3 text-right" for="projectname">Projectnaam<span class="req"> *</span></label>
                                    <div class="controls col-md-9"> 
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
                            <div class="form-group row" rel="popover" data-trigger="hover" data-content="Projectomschrijving" data-original-title="">
                                <label class="control-label control-label-right col-md-3 text-right" for="projectdescription">Projectomschrijving</label>
                                <div class="controls col-md-9">
                                    <textarea class="form-control" id="description" row="5" name="description" value="" class="form-control k-textbox" data-role="text" data-parsley-minwords="1" style="cursor: auto;" type="text">{{ $project->description }}</textarea>
                                </div>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row" rel="popover" data-trigger="hover" data-content="Adres" data-original-title="">
                                <label class="control-label control-label-right col-md-3 text-right" for="adres">Straatnaam & nummer</label>
                                <div class="controls col-md-9">
                                    <input id="streetname_number" name="streetname_number" value="{{ $project->streetname_number }}" class="form-control k-textbox" data-role="text" data-parsley-minwords="2" style="cursor: auto;" type="text">
                                </div>

                                @if ($errors->has('streetname_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('streetname_number') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row col-md-12" rel="popover" data-trigger="hover" data-content="Adres" data-original-title="">
                                <label class="control-label control-label-right col-md-3 text-right" for="adres">Postcode: </label>
                                <div class="controls col-md-2">
                                    <input id="postal_code" name="postal_code" value="{{ $project->postal_code }}" class="form-control k-textbox" data-role="text" data-parsley-minwords="2" style="cursor: auto;" type="text">
                                </div>

                                <label class="control-label control-label-right col-md-2 text-right" for="adres">Plaats: </label>
                                <div class="controls col-md-5 text-right">
                                    <input id="city" name="city" value="{{ $project->city }}" class="form-control k-textbox" data-role="text" data-parsley-minwords="1" style="cursor: auto;" type="text">
                                </div>

                                @if ($errors->has('postal_code'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                                @endif

                                @if ($errors->has('city'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row col-md-12" rel="popover" data-trigger="hover" data-content="Contactgegevens" data-original-title="">
                                <label class="control-label control-label-right col-md-3 text-right" for="adres">Website: </label>
                                <div class="controls col-md-4">
                                    <input id="website" name="website" value="{{ $project->website }}" class="form-control k-textbox" data-role="text" data-parsley-minwords="2" style="cursor: auto;" type="text">
                                </div>

                                <label class="control-label control-label-right col-md-2 text-right" for="adres">Email: </label>
                                <div class="controls col-md-3 text-right">
                                    <input id="email" name="email" value="{{ $project->email }}" class="form-control k-textbox" data-role="text" data-parsley-minwords="1" style="cursor: auto;" type="text">
                                </div>

                                @if ($errors->has('website'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row" rel="popover" data-trigger="hover" data-content="Phone" data-original-title="">
                                <label class="control-label control-label-right col-md-3 text-right" for="adres">Telefoonnummer</label>
                                <div class="controls col-md-4">
                                    <input id="phone" name="phone" value="{{ $project->phone }}" class="form-control k-textbox" data-role="text" data-parsley-minwords="1" style="cursor: auto;" type="text">
                                </div>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12 row" rel="popover" data-trigger="hover" data-content="Startdatum van het project" data-original-title="">
                                <label class="control-label control-label-right col-md-3 text-right" for="start_date">Startdatum<span class="req"> *</span></label>
                                <div class="controls col-md-3">                                    
                                    <p><input type="date" class="date form-control" id="start_date" name="start_date" value="{{\Carbon\Carbon::parse($project->start_date)->format('Y-m-d')}}" data-role="date" required="required" style="cursor: auto;"></p>
                                </div>

                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                           
                            
                            {{-- <div class="form-group col-md-3" rel="popover" data-trigger="hover" data-content="Geplande einddatum van het project" data-original-title=""> --}}
                                <label class="control-label control-label-right col-md-3 text-right" for="due_date">Geplande einddatum</label>

                                <div class="col-md-3">
                                    <p><input type="date" class="date form-control" id="due_date" name="due_date" value="{{\Carbon\Carbon::parse($project->due_date)->format('Y-m-d')}}" data-role="date" style="cursor: auto;"></p>
                                </div>

                                @if ($errors->has('due_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('due_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        
                            
                            <div class="form-group row" rel="popover" data-trigger="hover" data-content="Genoeg leden" data-original-title="">
                                <label class="control-label control-label-right col-md-3 text-right">Heeft genoeg medewerkers:</label>
                                <div class="col-md-1">
                                    @if ($project->enough_members)
                                        <input type="checkbox" class="form-check-input form-control" name="enough_members" value="enough_members" checked>
                                    @else
                                        <input type="checkbox" class="form-check-input form-control" name="enough_members" value="enough_members">
                                    @endif
                                </div>                                
                            </div>

                            <div class="form-group row">
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
                                    <div class="form-group col-md-12 text-right">
                                        <button id="afmelden" name="afmelden" value="afmelden" type="submit" class="btn btn-danger btn-lg">Afmelden</button>
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