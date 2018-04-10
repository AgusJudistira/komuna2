@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card">
                <div class="col-md-12 text-right">
                    <h4><a href="{{ url()->previous() }}">&lt; Terug naar overzicht</a></h4>
                </div>
                <h4><div class="card-header">Misschien uitnodigen voor het project <a href='/projects/{{$project->id}}' target='_blank'>{{$project->name}}</a>?</div></h4>
                <div class="card-body">                    

                    <div class="card-header">  
                        <h5>Persoonlijke gegevens</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12" style="min-height: 25vh;">
                            <img class="rounded float-right" src="/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; margin: 25px; border-radius: 50%;">
                                                                                        
                            <span class="t">Naam:</span><span class=""> {{ $user->firstname }} {{ $user->lastname }} </span><br />
                            @if($user->birthday != null)
                                <span class="t">Leeftijd:</span><span class=""> {{$age}} </span><br />
                            @endif                
                            @if( $user->streetname_number != null )
                                <span class="t">Straat en huisnummer:</span><span class=""> {{ $user->streetname_number }} </span><br />
                            @endif
                            @if( $user->postal_code != null )
                                <span class="t">Postcode:</span><span class=""> {{ $user->postal_code }} </span><br />
                            @endif
                            @if( $user->city != null )
                                <span class="t">Stad:</span><span class=""> {{ $user->city }} </span><br />
                            @endif
                            @if( $user->phone_private != null )
                                <span class="t">telefoon:</span><span class=""> {{ $user->phone_private }} </span><br />
                            @endif
                            @if( $user->phone_work != null )
                                <span class="t">telefoon werk:</span><span class=""> {{ $user->phone_work }} </span><br />
                            @endif                            
                            
                        </div>
                    </div>
                    
                    <div class="card-header">  
                        <h5>Competenties & Skills</h5>                      
                    </div>
                    <!-- Competences -->
                    <form class="form-group ml-1" method="POST" action="{{route('users.detach_competences', $user)}}">
                        @foreach ($competences_selected as $competence_selected)
                        {{csrf_field()}}
                       <div class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ $competence_selected->description }}"class="btn btn-default float-left ml-1 mb-1" >{{ $competence_selected->competence }}</div>
                        @endforeach
                    </form>

                    <!-- Skills -->
                    <form class="form-group ml-1" method="POST" action="{{route('users.detach_skills', $user)}}">
                        @foreach ($skills_selected as $skill_selected)
                        {{csrf_field()}}
                        <div class="badge badge-pill badge-warning" data-toggle="tooltip" title="{{ $skill_selected->description }}"class="btn btn-default float-left ml-1 mb-1" >{{ $skill_selected->skill }}</div>
                        @endforeach
                    </form>

                    <div class="card-header">  
                        <h5>Betrokken bij project</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <table class="table table-striped col-md-12">
                            <tr>
                                <th>Projectnaam</th>                                
                                <th>Begonnen op</th>                                
                                <th>Beindigd op</th>                
                            </tr>

                            @foreach ($projects as $one_project)
                                <tr>
                                    <td><a href="/projects/{{$one_project->id}}"> {{$one_project->name}}</a>@if ($one_project->pivot->projectowner) (eigen project) @endif</td>
                                    @if ($one_project->pivot->projectowner)
                                        <td>{{$one_project->start_date}}</td>
                                    @else
                                        <td> {{$one_project->pivot->start_date_user}}</td>
                                    @endif
                                    
                                    @if ($one_project->pivot->projectowner)
                                        @if ($one_project->due_date < date("Y-m-d H:i:s"))
                                            <td>{{$one_project->due_date}}</td>
                                        @else
                                            <td>Nog bezig</td>
                                        @endif
                                    @else
                                        <td>Nog bezig</td>                                    
                                    @endif
                                </tr>
                            @endforeach

                            @foreach ($projectExperiences as $projectExperience)
                                <tr>
                                    <td><a href="/projects/{{$projectExperience->id}}"> {{$projectExperience->name}}</a></td>
                                    <td> {{$projectExperience->pivot->start_date_user}}</td>
                                    <td> {{$projectExperience->pivot->end_date_user}}</td>
                                </tr>
                            @endforeach

                        </table>
                        </div>
                    </div>
                    <!-- Workexperience -->
                    <div class="card-header">  
                        <h5>Werkervaring</h5>                      
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <table class="table table-striped col-md-12">
                            <tr>
                                <th>Organisatie</th>
                                <th>Functie</th>                
                                <th>Begonnen op</th>                                
                                <th>Beindigd op</th>                
                            </tr>
                            @foreach ($workExperiences as $workExperience)
                                <tr>
                                    <td> {{$workExperience->name}}</td>
                                    <td> {{$workExperience->position}}</td>
                                    <td> {{$workExperience->start_date}}</a></td>
                                    <td> {{$workExperience->end_date}}</a></td>
                                </tr>
                            @endforeach
                        </table>
                        </div>
                    </div><br /><br />

                    <!-- Studyhistory -->
                    <div class="card-header">  
                        <h5>Studiervaring</h5>                      
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <table class="table table-striped col-md-12">
                            <tr>
                                <th>Opleiding</th>
                                <th>Niveau</th>                
                                <th>Begonnen op</th>                                
                                <th>Beindigd op</th>
                                <th>Diploma</th>               
                            </tr>
                            @foreach ($studyExperiences as $studyExperience)
                                <tr>
                                    <td>{{$studyExperience->name}}</td>
                                    <td>@switch($studyExperience)
                                            @case($studyExperience->level == 2)
                                                 <span>Cursus</span>
                                            @break
                                            @case($studyExperience->level == 3)
                                                 <span>MBO</span>
                                            @break
                                            @case($studyExperience->level == 4)
                                                 <span>HBO</span>
                                            @break
                                            @case($studyExperience->level == 5)
                                                 <span>WO</span>
                                            @break
                                            @case($studyExperience->level == 6)
                                                 <span>MBA</span>
                                            @break
                                            @case($studyExperience->level == 7)
                                                 <span>Post-doc</span>
                                            @break
                                        
                                            @default
                                                <span></span>
                                        @endswitch
                                    </td>
                                    <td>{{$studyExperience->start_date}}</td>
                                    <td>{{$studyExperience->end_date}}</td>
                                    <td>{{$studyExperience->diploma}}</td>
                                </tr>
                            @endforeach    
                        </table>
                        </div>
                    </div><br />
                </div>         
                <div class="card-footer">                    
                    <form method="POST" action="/projects/prepare_invitation">
                        @csrf                        
                        {{--  <div class="col-md-12 offset-md-10"><button type="submit" class="btn btn-primary btn-lg">Uitnodigen</div>  --}}
                        <div class="row">
                            <div class="col-md-6 text-right"><button name="inquire" value="inquire" type="submit" class="btn btn-primary btn-lg">Vraagje...</div>
                            <div class="col-md-6"><button name="invite" value="invite" type="submit" class="btn btn-primary btn-lg">Uitnodigen</div>
                        </div>
                        <input type="hidden" name="project_id" value="{{$project->id}}">
                        <input type="hidden" name="invitee_id" value="{{$user->id}}">                            
                    </form>
                </div>
            </div>                                                            
        </div>
    </div>
</div>

@endsection
