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
                        <p> {{ $project->description }}</p>
						<p> start: {{ $project->start_date }} </p>
                        <p> deadline: {{ $project->due_date }}</p>

                        <div class="row">
                            <div class="col-md-12">
                                Projectleden:
                            </div>
                        </div>
                        <ul>                            
                            @foreach ($list_of_projectusers as $projectuser)                                
                                <li class="col-md-6">{{ $projectuser->firstname . " " . $projectuser->lastname }}@if ($projectuser->pivot->projectowner) (eigenaar)@endif</li>
                            @endforeach                            
                        </ul>
                                  
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

                                <form method="POST" action="/projects/seekMembers">
                                    {{csrf_field()}}
                                    <div class="col-md-6 text-right">
                                        <button id="seek-members" name="seek-members" value="seek-members" type="submit" class="btn btn-primary btn-lg">Vrijwilligers zoeken</button>
                                    </div>
                                    <input type="hidden" name="project_id" value="{{$project->id}}">
                                    </div>                    
                                </form>
                            </div>
                        @elseif (!$isProjectMember)
                            <form method="GET" action="/projects/join/{{$project->id}}">
                                {{csrf_field()}}
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-8">
                                    <button id="aanmelden" name="aanmelden" value="aanmelden" type="submit" class="btn btn-primary btn-lg">Voor het project aanmelden</button>
                                </div>
                            </form>                            
                        @endif
                    </div>
                </div>
            </div>
        </div>

	</div>   
</div>         
@endsection