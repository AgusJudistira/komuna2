@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h2>{{$msg_titel}}</h2>
        <table class="table table-responsive table-striped">
            <thead>
                @if ($msg_titel == "Verzonden berichten")
                    <th>Naar</th>
                @else
                    <th>Van</th>
                @endif
                
                <th>Onderwerp</th>
                <th>Datum</th>
            </thead>
            @foreach ($messages as $msg)
                <tr>
                    @if ($msg_titel == "Verzonden berichten")
                        <td>{{$msg->recipient()->first()->firstname . " " . $msg->recipient()->first()->lastname}}</td>
                    @else
                        <td>{{$msg->sender()->first()->firstname . " " . $msg->sender()->first()->lastname}}</td>
                    @endif
                    
                    <td>{{$msg->subject}}</td>
                    <td>{{$msg->created_at}}</td>                        
                    {{--  <div class="card-body">                  
                        <p class="primary-txt">{!! $msg->message !!}</p>
                    </div>                      --}}
                    
                </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection



