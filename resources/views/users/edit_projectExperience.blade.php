@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-group">
                <div class="card">                    
                    <div class="card-header">  
                        <h5>Vrijwilligersprojecten</h5>                      
                    </div>
                    <div class="card-body">  
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-group" method="POST" action="{{route('users.detach_projects', $user, $projects)}}">
                                    {{csrf_field()}}
                                    <table class="table table-striped col-md-12">
                                        <thead>
                                            <tr>
                                                <th>Actieve projecten</th>
                                            </tr>
                                            <tr>
                                                <th>Project</th>
                                                <th>Begonnen op</th>
                                                <th>Aanvinken om te verlaten</th>
                                            </tr>
                                        </thead>
                                        @foreach ($projects as $project)
                                            <tr>
                                                <td> {{$project->name}}</td>                                                
                                                <td> {{$project->pivot->start_date_user}}</a></td>                                                
                                                <td>                                                
                                                    <label><input type="checkbox" name="exited_projects[]" value="{{$project->id}}"> Verlaten</label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-danger ml-auto float-right" role="button">
                                            {{ __('Project(en) verlaten') }}
                                        </button> 
                                    </div>
                                </form>
                                <table class="table table-striped col-md-12">
                                    <thead>
                                        <tr>
                                            <th>Verlaten projecten</th>
                                        </tr>
                                        <tr>
                                            <th>Project</th>
                                            <th>Begonnen op</th>
                                            <th>Beeindigd op</th>
                                        </tr>
                                    </thead>
                                    @foreach ($projectExperiences as $projectExperience)
                                        <tr>
                                            <td> {{$projectExperience->name}}</td>                                            
                                            <td> {{$projectExperience->pivot->start_date_user}}</td>                                            
                                            <td> {{$projectExperience->pivot->end_date_user}}</td>                                                                                        
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-md-12">
                            <form class="col-md-2 float-left" method="GET" action="/users/{{Auth::user()->id}}/edit_skills"> 
                                <button type="submit" class="btn btn-primary ml-auto" role="button">
                                    {{ __('Vorige') }}
                                </button> 
                            </form>
                            <!-- Naar volgende -->
                            <form class="col-md-2 float-right" method="GET" action="/users/{{Auth::user()->id}}/edit_workExperience">
                                <button type="submit" class="btn btn-primary ml-auto" role="button">
                                    {{ __('Volgende') }}
                                </button> 
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
         </div>
     </div>
 </div>

@endsection