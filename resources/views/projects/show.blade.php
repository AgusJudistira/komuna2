@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <h4><a href="/projects">&lt; Terug naar projectoverzicht</a></h4>
        </div>
        <div class="col-md-8">            

           	<div class="form-group">
                <div class="card">
                    <div class="card-header">  
                    	<h1>Project: {{ $project->name }} </h1>                     
                    </div>
                    <div class="card-body">
                        <p class="card-text"> {{ $project->description }}</p>
						<p> start: {{ $project->start_date }} </p>
                        <p> deadline: {{ $project->due_date }}</p>

                        @if ($project->enough_members)
                            <p class="text-danger">Er zijn al genoeg vrijwilligers. Ledenwerving gestopt</p>
                        @endif
                        
                        <div class="row">
                            <div class="col-md-12">Benodigde competenties:</div>
                        </div>
                        <h5>
                            @foreach ($competences as $competence)
                                <span class="badge badge-pill badge-success">{{ $competence->competence }}</span>
                            @endforeach
                        </h5>

                        <div class="row">
                            <div class="col-md-12">
                                Projectleden:
                            </div>
                        </div>
                        
                        <h5>
                            @foreach ($list_of_projectusers as $projectuser)
                                @if ($projectuser->pivot->projectowner)
                                    <span class="badge badge-pill badge-info">{{ $projectuser->firstname . " " . $projectuser->lastname }}  (eigenaar)</span>
                                @else
                                    <span class="badge badge-pill badge-secondary">{{ $projectuser->firstname . " " . $projectuser->lastname }}</span>
                                @endif
                            @endforeach                            
                        </h5>
                                  
                    </div>
                    <div class="card-footer">
                        @if ($isProjectOwner)
                            <div class="row text-right">
                                <form method="POST" action="/projects/edit">
                                    {{csrf_field()}}
                                    <div class="col-md-6 text-right">     
                                        <button id="edit" name="edit" value="edit" type="submit" class="btn btn-primary btn-lg">Project wijzigen</button>
                                    </div>
                                    <input type="hidden" name="project_id" value="{{$project->id}}">
                                    
                                </form>
                                @if (!$project->enough_members)
                                    <form method="GET" action="/projects/seekMembers">
                                        {{csrf_field()}}
                                        <div class="col-md-6 text-right">                                        
                                            <button id="seek-members" name="seek-members" value="seek-members" type="submit" class="btn btn-primary btn-lg">Vrijwilligers zoeken</button>
                                        </div>
                                        <input type="hidden" name="project_id" value="{{$project->id}}">
                                        </div>
                                    </form>
                                @endif
                            </div>
                        @elseif (!$isProjectMember)
                            <form class="form-group row" method="GET" action="/projects/join/{{$project->id}}">
                                {{csrf_field()}}
                                <div class="col-md-6 text-right">
                                    <button name="inquire" value="inquire" type="submit" class="btn btn-primary btn-lg">Vraagje...</button>
                                </div>

                                @if (!$project->enough_members)
                                    <div class="col-md-6">
                                        <button id="join" name="join" value="join" type="submit" class="btn btn-primary btn-lg">Voor het project aanmelden</button>
                                    </div>
                                @endif
                            </form>                            
                        @endif
                    </div>
                </div>
            </div>
        </div>

	</div>   
</div>         
@endsection