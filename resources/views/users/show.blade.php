
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Persoonlijk profiel van<h5>{{ $user->firstname }} {{ $user->lastname }}</h5>
                </div>
                    <!-- Personal data -->

                    <div class="card-header">  
                        <a class="float-right" href="{{ URL::previous() }}">terug</a>
                        <h5>Personlijke gegvens</h5>                 
                    </div>
                    <div class="card-body">
                        <div style="min-height: 25vh">
                        <img class="rounded float-right" src="/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; margin: 20px; margin-top: 7px; border-radius: 50%;">
                            <p class="m-3">
                                <span class="">Naam:</span> {{ $user->firstname }} {{ $user->lastname }} <br />
                                @if($user->birthday != null)
                                <span class="">Leeftijd:</span> {{$age}} <br />
                                @endif                
                                @if( $user->streetname_number != null )
                                <span class="">Straat en huisnummer:</span> {{ $user->streetname_number }} <br />
                                @endif
                                @if( $user->postal_code != null )
                                <span class="">Postcode:</span> {{ $user->postal_code }} <br />
                                @endif
                                @if( $user->city != null )
                                <span class="">Stad:</span> {{ $user->city }} <br />
                                @endif
                                @if( $user->phone_private != null )
                               <span class="">telefoon:</span> {{ $user->phone_private }} <br />
                                @endif
                                @if( $user->phone_work != null )
                               <span class="">telefoon werk:</span> {{ $user->phone_work }} <br />
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="card-header">  
                        <h5 class="">Reviews</h5>                      
                    </div>
                    <div class="card-body">
                        <div style="min-height: 25px" class="float-right">
                            <div class="stars">
                                @if($rating < 0.5 )
                                <span class="star mr-2"></span>  
                                    @elseif($rating >= 0.5 && $rating < 1)
                                <span class="star half mr-2"></span>
                                        @else($rating > 1 )
                                <span class="star on mr-2"></span>
                                @endif
                                @if($rating < 1.5 )
                                <span class="star mr-2"></span>   
                                    @elseif($rating >= 1.5 && $rating < 2)
                                <span class="star half mr-2"></span>    
                                        @else($rating >= 2 )
                                <span class="star on mr-2"></span>
                                @endif
                        
                                @if($rating < 2.5 )
                                <span class="star mr-2"></span>
                                    @elseif($rating >= 2.5 && $rating < 2.9)
                                <span class="star half mr-2"></span>
                                        @else($rating >= 2.9 )
                                <span class="star on mr-2"></span>
                                @endif
                        
                                @if($rating < 3.5 )
                                <span class="star mr-2"></span>
                                    @elseif($rating >= 3.5 && $rating < 3.85)
                                <span class="star half mr-2"></span>
                                        @else($rating >= 3.85 )
                                <span class="star on mr-2"></span>
                                @endif
                            </div>
                        
                            <form class="" method="POST" action="{{route('users.store_rating', $user)}}">
                            {{csrf_field()}}
                                <input type="hidden" value="{{Auth::user()->id}}" name="rating_user_id">
                                <input type="hidden" value={{"$user->id"}} name=rated_user_id>
                            
                                <div class="rating">
                                    <span class="mr-5"><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label></span>
                                    <span class="mr-5"><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label></span>
                                    <span class="mr-5"><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label></span>
                                    <span class="mr-5"><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label></span>
                                </div>
                                <input class="btn btn-primary ml-auto mr-5 mt-3 float-right"  type="submit" value="rate" name="submit">
                            </form>
                        </div> 
                    </div>

                    <!-- Competences -->
                     <div class="card-header">  
                        <h5>Competenties & Skills</h5>                      
                    </div>
                    <div class="card-body">
                        <form class="form-group ml-1" method="POST" action="{{route('users.detach_competences', $user)}}">
                            @foreach ($competences_selected as $competence_selected)
                            {{csrf_field()}}
                           <span class="badge badge-pill badge-success" data-toggle="tooltip" title="{{ $competence_selected->description }}"class="btn btn-default float-left ml-1     mb-1" >{{ $competence_selected->competence }}</span>
                            @endforeach
                        </form>
    
                        <!-- Skills -->
                        <form class="form-group ml-1" method="POST" action="{{route('users.detach_skills', $user)}}">
                            @foreach ($skills_selected as $skill_selected)
                            {{csrf_field()}}
                            <span class="badge badge-pill badge-warning" data-toggle="tooltip" title="{{ $skill_selected->description }}"class="btn btn-default float-left ml-1 mb-1"   >{{ $skill_selected->skill }}</span>
                            @endforeach
                        </form>
                    </div>
                    
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
                            @foreach ($projects as $project)
                                <tr>
                                    <td><a href="/projects/{{$project->id}}"> {{$project->name}}</a></td>
                                    <td> {{$project->pivot->start_date_user}}</td>
                                    
                                    @if($project->pivot->end_date_user == null)
                                        <td> Nog bezig </td>
                                    @else
                                        <td> {{$project->pivot->end_date_user}}</td>
                                    @endif
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
                                    <td> {{$workExperience->start_date}}</td>
                                    @if($workExperience->end_date == null)
                                    <td> Nog bezig </td>
                                    @else
                                    <td> {{$workExperience->end_date}}</td>
                                    @endif
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
                                            @case($studyExperience->level == 1)
                                                 <span>Cursus</span>
                                            @break
                                            @case($studyExperience->level == 2)
                                                 <span>VO</span>
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
                    </div><br /><br />
                </div>
        </div>
        <div class="card-footer">
            <form class="form-group" method="GET" action="/messages/msg-index">
                {{ csrf_field() }}
                <div class="row">
                </div>
            </form>
        </div>
    </div>
</div>
 
@endsection
