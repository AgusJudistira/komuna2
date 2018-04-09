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
                                                <th>Huidige deelneming projecten</th>
                                            </tr>
                                            <tr>
                                                <th>Project</th>
                                                <th>Begonnen op</th>
                                                <th>Aanvinken om te verlaten</th>
                                            </tr>
                                        </thead>
                                        @foreach ($projects as $project)                                            
                                            <tr>
                                                <td><a href="/projects/{{$project->id}}"> {{$project->name}}</a></td>
                                                
                                                    @if ($project->pivot->projectowner)
                                                        <td> {{$project->start_date}}</td>
                                                    @else
                                                        <td> {{$project->pivot->start_date_user}}</td>
                                                    @endif
                                                    
                                                    </a>
                                                
                                                <td>
                                                    @if ($project->pivot->projectowner)                                                                                                       
                                                        <span>Eigen project kan niet verlaten worden</span>
                                                    @else
                                                        <label><input type="checkbox" name="exited_projects[]" value="{{$project->id}}"> Verlaten</label>
                                                    @endif
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
                                            <th>Deelgenomen projecten</th>
                                        </tr>
                                        <tr>
                                            <th>Project</th>
                                            <th>Begonnen op</th>
                                            <th>Beeindigd op</th>
                                        </tr>
                                    </thead>
                                    @foreach ($projects as $project)
                                        
                                        @if ($project->pivot->projectowner && $project->due_date < date("Y-m-d H:i:s") && strtotime($project->due_date) == true)
                                            <tr>
                                                <td><a href="/projects/{{$project->id}}"> {{$project->name}}</a> (eigen project) </td>
                                                <td>{{$project->start_date}}</td>                                                                                                
                                                <td>{{$project->due_date}}</td>                                                
                                            </tr>
                                        @endif
                                    @endforeach

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
                            <form class="col-md-2 float-left" method="GET" action="/users/{{Auth::user()->id}}/edit_studyExperience"> 
                                <button type="submit" class="btn btn-primary ml-auto" role="button">
                                    {{ __('Vorige') }}
                                </button> 
                            </form>
                            <!-- Naar volgende -->

                            <form class="col-md-2 float-right" method="GET" action="/users/{{Auth::user()->id}}/show"> 
                                <button type="submit" class="btn btn-primary ml-auto" role="button">
                                    {{ __('Profiel overzicht') }}
                                </button> 
                           </form>     

                            {{-- <form class="col-md-2 float-right" method="GET" action="/users/{{Auth::user()->id}}/edit_workExperience">
                                <button type="submit" class="btn btn-primary ml-auto" role="button">
                                    {{ __('Volgende') }}
                                </button> 
                            </form>   --}}
                        </div>
                    </div>
                </div>
            </div>
         </div>
     </div>
 </div>

@endsection