@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="card">
            <div class="card-header row">
                <div class="col-md-12">
                    <h3>Vrijwilligers </h3>
                    
                </div>
                <div class="text-right">
                    
                </div>
            </div>
            <div class="card-body">
               
                <table class="table table-striped col-md-12">
                    <thead>
                        <th>Naam</th>                
                        <th>Geslacht</th>                                
                        <th>Woonplaats</th>
                        <th>Vaardigheden</th>
                        <th>Competenties</th>               
                    </thead>
                    @foreach ($users as $user)
                        @if ($user->id != Auth::guard('web')->user()->id)
                            <tr>
                                <td><a href="/users/{{$user->id}}/show">{{$user->firstname}} {{$user->lastname}}</a>
                                <td><a href="/users/{{$user->id}}/show">{{$user->gender}}</a>
                                <td><a href="/users/{{$user->id}}/show">{{$user->city}}</a>  
                                <td>
                                    @foreach ($user->skill as $skill_selected)
                                        <span class="badge badge-pill badge-warning">
                                            {{$skill_selected->skill}}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($user->competence as $one_competence)
                                        <span data-toggle="tooltip" title='{{$one_competence->description}}' class="badge badge-pill badge-success">
                                            {{$one_competence->competence}}
                                        </span>
                                    @endforeach
                                </td>
                            </tr> 
                        @endif
                    @endforeach
                </table> 
            </div>
        </div>
    </div>
</div>

@endsection




