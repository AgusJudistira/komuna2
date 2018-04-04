@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="col-md-12 text-right">
                <h4><a href="{{ url()->previous() }}">&lt; Terug naar overzicht</a></h4>
            </div>
            <div class="card">
                <h4><div class="card-header">Misschien uitnodigen voor het project <a href='/projects/{{$project->id}}' target='_blank'>{{$project->name}}</a>?</div></h4>

                <div class="card-body">                                
                    <div class="row">
                        <div class="col-md-3">Naam:</div>
                        <div class="col-md-7">{{$invitee->firstname . " " . $invitee->lastname}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Geslacht:</div>
                        <div class="col-md-7">{{$invitee->gender}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Woonplaats:</div>
                        <div class="col-md-7">{{$invitee->city}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Korte introductie:</div>
                        <div class="col-md-7"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Competenties:</div>
                        <div class="col-md-7">
                            @foreach ($invitee_competences as $competence)
                                <span class="badge badge-pill badge-success" title="{{$competence->description}}">{{$competence->competence . ", "}}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Studie-ervaring:</div>
                        <div class="col-md-7"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Werkervaring:</div>
                        <div class="col-md-7"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">Hobbies/interesses:</div>
                        <div class="col-md-7"></div>
                    </div>
                </div>                            
                <div class="card-footer">                    
                    <form method="POST" action="/projects/prepare_invitation">
                        @csrf                        
                        {{--  <div class="col-md-12 offset-md-10"><button type="submit" class="btn btn-primary btn-lg">Uitnodigen</div>  --}}
                        <div class="row">
                            <div class="col-md-6 text-right"><button name="inquire" value="inquire" type="submit" class="btn btn-primary btn-lg">Vraagje...</div>
                            <div class="col-md-6"><button name="invite" value="invite" type="submit" class="btn btn-primary btn-lg">Uitnodigen</div>
                        </div>
                        <input type="hidden" name="project_id" value="{{$project->id}}">
                        <input type="hidden" name="invitee_id" value="{{$invitee->id}}">                            
                    </form>
                </div>
            </div>                                                            
        </div>
    </div>
</div>

@endsection
