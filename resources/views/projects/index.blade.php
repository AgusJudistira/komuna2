@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form action="projects.index" method="post" role="form">
            {{ csrf_field() }}
            <div class="form-group row">
                <label class="control-label control-label-left col-md-4" for="phonenumber">Zoek in projecten op: </label>
                <div class="controls col-md-7">                    
                    <input id="searchstring" name="searchstring" class="form-control k-textbox" data-role="text" type="text">
                </div>     

                <div class="controls col-md-1">
                    <button id="zoek" name="zoek" value="zoek" type="submit" class="btn btn-info btn-lg">Zoek</button>
                </div>                               
            </div>
        </form>

        <div class="col-md-8">
        
        @foreach ($projects as $project)
           <div class="form-group">
                <div class="card">
                    <div class="card-header">  
                        <a href="/projects/{{$project->id}}">
                            {{ $project->name }}  
                        </a>                        
                    </div>
                    <div class="card-body">
                        <div class="projectSummary">          
                            <p>
                                {{ $project->description }}
                            </p>
                            <p>                        
                                deadline: {{ $project->due_date }}
                            </p>
                            <p>Project owner(s):</p>
                                <ul>
                                    @foreach ($project->user as $user)
                                        @if ($user->projectowner)
                                            <li>{{ $user->firstname . " " . $user->lastname}}</li>
                                        @endif
                                    @endforeach                                
                                </ul>
                            </p> 
                        </div>
                    </div>
                 </div>
            </div>
        @endforeach
        </div>   
    </div>         
</div>
@endsection



