@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           	<div class="form-group">
                <div class="card">
                    <div class="card-header">  
                    	<h1> {{ $project->name }} </h1>                     
                    </div>
                    <div class="card-body">
                        <p> {{ $project->description }}</p>
						<p> start: {{ $project->start_date }} </p>
                        <p> deadline: {{ $project->due_date }}</p>

                        <div class="row">
                            <div class="col-md-12">
<<<<<<< HEAD
                                Project owner(s):
                            </div>
                        </div>
                        <div class="row">
                            
                            @foreach ($list_of_projectusers as $projectuser)
                                @if ($projectuser->pivot->projectowner)                                
                                    <div class="col-md-4">{{ $projectuser->firstname . " " . $projectuser->lastname }}</div>
                                    <div class="col-md-4">{{ $projectuser->email}}</div>
                                    <div class="col-md-4">{{ $projectuser->phone_work}}</div>
                                @endif
                            @endforeach
                            
                        </div>
=======
                                Project user(s):
                            </div>
                        </div>
                        <ul>
                            
                            @foreach ($list_of_projectusers as $projectuser)                                
                                <li class="col-md-6">{{ $projectuser->firstname . " " . $projectuser->lastname }}@if ($projectuser->pivot->projectowner) (proj. owner)@endif</li>
                                {{--  <div class="col-md-6"></div>  --}}
                                {{--  <div class="col-md-4">{{ $projectuser->email}}</div>                                                                                               
                                <div class="col-md-2">{{ $projectuser->phone_work}}</div>  --}}
                            @endforeach
                            
                        </ul>
>>>>>>> e31b5820969f83be5c269ba5b083905eb247fc0e
                                                
                    </div>
                    <div class="card-footer">
                        @if ($isProjectOwner)
                            <form method="get" action="/projects/edit/{{$project->id}}">
                                <div class="row"> 
                                    <div class="col-md-4">     
                                    </div>
                                    <div class="col-md-8">     
                                        <button id="wijzigen" name="wijzigen" value="wijzigen" type="submit" class="btn btn-primary btn-lg">Project wijzigen</button>
                                    </div>
                                </div>                    
                            </form>
<<<<<<< HEAD
                        @else
                        
                            <form method="get" action="/projects/join/{{$project->id}}">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <button id="aanmelden" name="aanmelden" value="aanmelden" type="submit" class="btn btn-primary btn-lg">Voor het project aanmelden</button>
                                </div>
                            </form>
                        
=======
                        @elseif (!$isProjectMember)
                            <form method="get" action="/projects/join/{{$project->id}}">
                                {{csrf_field()}}
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-8">
                                    <button id="aanmelden" name="aanmelden" value="aanmelden" type="submit" class="btn btn-primary btn-lg">Voor het project aanmelden</button>
                                </div>
                            </form>                            
>>>>>>> e31b5820969f83be5c269ba5b083905eb247fc0e
                        @endif
                    </div>
                </div>
            </div>
        </div>
	</div>   
</div>         
@endsection