@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-group">
                <div class="card">
                    <div class="card-header">  
                        <h4>Uitnodiging voor het project <b>{{$project->name}}</b>.</h4>    
                    </div>                  
                    <div class="card-body">  
                        <div class="row">
                            <div class="col-md-12">U bent van plan om {{$invitee->firstname . " " . $invitee->lastname}} uit te nodigen om aan het project: <b><i>{{ $project->name }}</i></b> te werken.</div>
                            <div class="col-md-12">Klik op <span class="bg-primary" style="color: white;">Uitnodiging versturen</span> om uit te nodigen.</div>
                            <div class="col-md-12">Een bericht naar de vrijwilliger zal verstuurd worden.</div>
                            {{--  {{dd($invitee->gender)}}  --}}
                            <div class="col-md-12">Na @if($invitee->gender == "Man") zijn @else haar @endif goedkeuring zal @if($invitee->gender == "Man") hij @else zij @endif direct aan het project gekoppeld worden.</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">  
                        <form class="form-group row" method="POST" action="/projects/send_invitation">
                            {{csrf_field()}}
                            <div class="col-md-6"></div>
                            <div class="col-md-2">                                    
                                <button id="cancel" name="cancel" value="cancel" type="submit" class="btn btn-info btn-lg">Annuleren</button>
                            </div>
                            <div class="col-md-3">                                    
                                <button id="invite" name="invite" value="invite" type="submit" class="btn btn-primary btn-lg">Uitnodiging versturen</button>
                            </div>
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <input type="hidden" name="invitee_id" value="{{ $invitee->id }}">
                        </form>

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
                        </div >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

