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
                
            <div class="row">
                <div class="col-md-12">
                    {!! $message->message !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <b><i>{!! $message->user_message !!}</i></b>
                </div>
            </div>
            <form id="decide" method="POST" action="/projects/decide">
                {{csrf_field()}}
                @if ($message->action_taken == 0)
                    @if ($message->recipient_id == Auth::guard('web')->user()->id)
                        {!! $message->actions !!}
                    @endif
                @elseif ($message->action_taken == 1)
                    <p class="text-success">Het verzoek is al geaccepteerd.</p>
                @elseif ($message->action_taken == 2)
                    <p class="text-danger">Het verzoek is al geweigerd.</p>
                @elseif ($message->action_taken == 3)
                    <p class="text-info">Dit bericht is al beantwoord.</p>
                @endif
                
                <input form="decide" type="hidden" name="message_id" value="{{$message->id}}">
                <input form="decide" type="hidden" name="project_id" value="{{$message->project_id}}">
            </form>
        </div>        
        <div class="card-footer">            
            <h4><a href="{{ url()->previous() }}">&lt; Terug naar overzicht</a></h4>
        </div>
    </div>
</div>

@endsection



