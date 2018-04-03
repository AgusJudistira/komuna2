@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-group">
                <form class="form-group row" method="POST" action="/projects/send_reply">
                    {{csrf_field()}}
                    <div class="card">
                        <div class="card-header">  
                            <h4>Antwoord op uw vraag</h4>    
                        </div>                  
                        <div class="card-body">  
                            <div class="row">
                                <div class="col-md-6">Van: {{$old_message->sender()->first()->firstname . " " . $old_message->sender()->first()->lastname}}</div>
                                <div class="col-md-6">Datum: {{$old_message->created_at}}</div>
                                <div class="col-md-12">Onderwerp: Re: {{ $old_message->subject }}</div>
                                <div class="col-md-12">Bericht: {!! $old_message->message !!}</div>
                                <div class="col-md-12">{!! $old_message->user_message !!}</div>
                                
                                <div class="col-md-12"><b><i>Typ uw antwoord hieronder:</b></i></div>
                                <textarea class="form-control" row="5" name="user_message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer col-md-12">                          
                        <div class="row">                        
                            <div class="col-md-12 text-right">
                                <button id="invite" name="reply" value="reply" type="submit" class="btn btn-primary btn-lg">Antwoord versturen</button>
                            </div>
                        </div>

                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <input type="hidden" name="recipient_id" value="{{ $old_message->sender_id }}">
                        <input type="hidden" name="old_message_id" value="{{ $old_message->id }}">
                        

                        <div class="form-group">
                            @if(count($errors))
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error) 
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>                
                </form>     
            </div>
        </div>
    </div>
</div>

@endsection

