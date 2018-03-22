@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <h1>{{$msg_titel}}</h1>
        @foreach ($messages as $msg)
            <div class="col-md-12">      
                <div class="card">
                    <div class="card-header">  
                        <h4>{{$msg->subject}}</h4>                        
                        <p>Verzonden door: {{$msg->sender()->first()->firstname . " " . $msg->sender()->first()->lastname}}</p>
                        <p>Verzonden aan: {{$msg->recipient()->first()->firstname . " " . $msg->recipient()->first()->lastname}}</p>
                    </div>
                    <div class="card-body">                  
                        <p class="primary-txt">{!! $msg->message !!}</p>
                    </div>                    
                </div>            
            </div>
        @endforeach
    </div>
</div>

@endsection



