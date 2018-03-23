@extends('layouts.app')

@section('content')

<div class="container">
        
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <h4>Onderwerp: {{$message->subject}}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">Van: {{$message->sender()->first()->firstname . " " . $message->sender()->first()->lastname}}</div>
                <div class="col-md-4">Naar: {{$message->recipient()->first()->firstname . " " . $message->recipient()->first()->lastname}}</div>
                <div class="col-md-4">Datum: {{$message->created_at}}</div>
            </div>               
            
        </div>
        <div class="card-body">
            {!! $message->message !!}
        </div>
        <div class="card-footer">
            <h4><a href="/home">&lt; Terug naar dashboard</a></h4>
        </div>
    </div>
</div>

@endsection



