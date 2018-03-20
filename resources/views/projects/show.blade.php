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
                                Projectowner(s):
                                <ul>
                                    @foreach ($list_of_projectowners as $projectowner)
                                        <li>{{ $projectowner->firstname . " " . $projectowner->lastname }}</li>
                                    @endforeach
                                </ul>
                                
                            </div>
                        </div>
                        @if ($isProjectOwner)
                            <form method="get" action="/projects/edit/{{$project->id}}">
                                <div class="row"> 
                                    <div class="col-md-4">     
                                    </div>
                                    {{--  <span> - [ <a href="/projects/edit/{{$project->id}}">Wijzig project</a> ]</span>  --}}
                                    <div class="col-md-8">     
                                        <button id="wijzigen" name="wijzigen" value="wijzigen" type="submit" class="btn btn-primary btn-lg">Project wijzigen</button>
                                    </div>
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