@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-6">
            <h2>{{$msg_type}}</h2>
        </div>
        <div class="col-md-6">
            <h4><a href="/home">&lt; Terug naar dashboard</a></h4>
        </div>

        <table class="table table-responsive table-striped">
            <thead>
                @if ($msg_type == "Verzonden berichten")
                    <th>Naar</th>
                @else
                    <th>Van</th>
                @endif
                
                <th>Onderwerp</th>
                <th>Datum</th>
            </thead>
            @foreach ($messages as $msg)
                <tr>
                    
                    @if ($msg_type == "Verzonden berichten")
                        <td><a href="/messages/msg-show/{{$msg->id}}">{{$msg->recipient()->first()->firstname . " " . $msg->recipient()->first()->lastname}}</a></td>
                    @else
                        <td><a href="/messages/msg-show/{{$msg->id}}">{{$msg->sender()->first()->firstname . " " . $msg->sender()->first()->lastname}}</a></td>
                    @endif
                    
                    <td><a href="/messages/msg-show/{{$msg->id}}">{{$msg->subject}}</a></td>
                    <td><a href="/messages/msg-show/{{$msg->id}}">{{$msg->created_at}}</a></td>                        

                </tr>
            @endforeach
        </table>
    </div>

</div>

@endsection



