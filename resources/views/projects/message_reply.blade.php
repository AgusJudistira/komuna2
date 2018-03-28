@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-group">
                <form class="form-group row" method="POST" action="/projects/send_inquiry">
                    {{csrf_field()}}
                    <div class="card">
                        <div class="card-header">  
                            <h4>Antwoord op uw vraag</h4>    
                        </div>                  
                        <div class="card-body">  
                            <div class="row">
                                <div class="col-md-6">Van: {{$this_message->sender()->first()->firstname . " " . $this_message->sender()->first()->lastname}}</div>
                                <div class="col-md-6">Datum: {{$this_message->created_at}}</div>
                                <div class="col-md-12">Onderwerp: {{ $this_message->subject }}</div>
                                <div class="col-md-12">Bericht: {!! $this_message->message !!}</div>
                                <div class="col-md-12">{!! $this_message->user_message !!}</div>
                                
                                <div class="col-md-12"><b><i>Typ uw antwoord hieronder:</b></i></div>
                                <textarea class="form-control" row="5" name="user_message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">                          
                        <div class="row">
                            <div class="col-md-4"></div>

                            <div class="col-md-4">
                                <button id="cancel" name="cancel" value="cancel" type="submit" class="btn btn-info btn-lg">Annuleren</button>
                            </div>
                            <div class="col-md-4">                                    
                                <button id="invite" name="inquire" value="inquire" type="submit" class="btn btn-primary btn-lg">Antwoord versturen</button>
                            </div>
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <input type="hidden" name="applicant_id" value="{{ $this_message->recipient_id }}">
                        </div>  

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

