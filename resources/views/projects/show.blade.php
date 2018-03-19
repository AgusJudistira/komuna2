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
                    </div>
                    @if ($isProjectOwner)
                        <p>Is projectowner</p>
                    @endif
                </div>
            </div>
        </div>
	</div>   
</div>         
@endsection