@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">            
            
        <form class="form-inline col-md-12" action="projects.index" method="post" role="form">
            {{ csrf_field() }}
            
            <div class="form-inline row">
            
                <label class="control-label control-label-right col-md-4" for="searchstring">Zoek in projecten op: </label>
                <div class="col-md-7">                    
                    <input id="searchstring" name="searchstring" class="form-control k-textbox" data-role="text" type="text">
                </div>     

                <div class="col-md-1">
                    <button id="zoek" name="zoek" value="zoek" type="submit" class="btn btn-info btn-lg">Zoek</button>
                </div>
            </div>
            
        </form>

        <form style="z-index: 3; position: fixed; bottom: 30px; right: 30px;" action="/projects/create" method="post" role="form">
            {{ csrf_field() }}
            <button id="start_project" name="start_project" value="start_project" type="submit" class="btn btn-info btn-lg">Nieuwe project starten</button>
        </form>

        <div class="col-md-12">        
            @foreach ($listed_projects as $project)                
                <div class="form-group">
                    <div class="card">
                        <div class="card-header">  
                            <a href="/projects/{{$project[1]->id}}">
                                {{ $project[1]->name }}  
                            </a>                        
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">          
                                    <p>
                                        {{ $project[1]->description }}
                                    </p>
                                    <p>                        
                                        deadline: {{ $project[1]->due_date }}
                                    </p>

                                </div>
                                <div class="col-md-12">
                                    Overeengekomen vaardigheden en competenties:
                                </div>
                                <div class="col-md-12">                                    
                                    @foreach ($project[2] as $skill)
                                        <span class="badge badge-pill badge-warning">
                                            {{$skill['skill']}}
                                        </span>
                                    @endforeach
                                </div>
                                <div class="col-md-12">
                                    @foreach ($project[3] as $competence)
                                        <span data-toggle="tooltip" title='{{$competence->description}}' class="badge badge-pill badge-success">
                                            {{$competence['competence']}}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            @if ($project[1]->enough_members)
                                <p class="text-danger">Er zijn al genoeg vrijwilligers. Ledenwerving gestopt</p>
                            @endif
                        </div>
                    </div>
                </div>                
            @endforeach
        </div>   
    </div>         
</div>
@endsection



