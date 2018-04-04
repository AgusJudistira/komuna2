@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-8">
            <h3>Vrijwilligers vinden voor het project: </h3>
            <h3><b>{{$thisProject->name}}</b></h3>
        </div>
        <div class="col-md-4 text-right">
            <h4><a href="/projects/{{$thisProject->id}}">&lt; Terug naar projectdetails</a></h4>
        </div>

        <table class="table table-striped">
            <thead>
                <th>Naam</th>                
                <th>Geslacht</th>                                
                <th>Woonplaats</th>
                <th>Vaardigheden match</th>
                <th>Competenties match</th>
            </thead>
            @foreach ($invitable_members as $invitee)
                <tr>
                    <td><a href="/projects/showInvitee/{{{$thisProject->id}}}/{{{$invitee[1]->id}}}">{{$invitee[1]->firstname . " " . $invitee[1]->lastname}}</a></td>
                    <td><a href="/projects/showInvitee/{{{$thisProject->id}}}/{{{$invitee[1]->id}}}">{{$invitee[1]->gender}}</a></td>
                    <td><a href="/projects/showInvitee/{{{$thisProject->id}}}/{{{$invitee[1]->id}}}">{{$invitee[1]->city}}</a></td>
                    
                    <td>
                        @foreach ($invitee[2] as $competence)
                            <span data-toggle="tooltip" title='{{$competence->description}}' class="badge badge-pill badge-success">
                                {{$competence['competence']}}
                            </span>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

</div>

@endsection



