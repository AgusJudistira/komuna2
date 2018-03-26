@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-6">
            <h3>Vrijwilligers vinden voor het project: </h3>
            <h3><b>{{$thisProject->name}}</b></h3>
        </div>
        <div class="col-md-6">
        <h4><a href="/projects/{{$thisProject->id}}">&lt; Terug naar projectdetails</a></h4>
        </div>

        <table class="table table-responsive table-striped">
            <thead>
                <th>Naam</th>                
                <th>Geslacht</th>                                
                <th>Woonplaats</th>                
            </thead>
            @foreach ($invitable_members as $invitee)
                <tr>
                    <td>{{$invitee->firstname . " " . $invitee->lastname}}</td>
                    <td>{{$invitee->gender}}</td>
                    <td>{{$invitee->city}}</td>
                </tr>
            @endforeach
        </table>
    </div>

</div>

@endsection



