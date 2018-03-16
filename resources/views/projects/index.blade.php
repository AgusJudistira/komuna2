@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
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
                        </div>
                    </div>
                 </div>
            </div>
        @endforeach
        </div>   
    </div>         
</div>
@endsection



