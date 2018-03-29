@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-group">
                <form class="form-group row" method="POST" action="/projects/send_project_inquiry">
                    {{csrf_field()}}
                    <div class="card">
                        <div class="card-header">  
                            <h4>Vraag over het project '{{$project->name}}'</h4>    
                        </div>                  
                        <div class="card-body">  
                            <div class="row">
                                <div class="col-md-12">U bent benieuwd of <b><i>{{$project->name}}</i></b> <u>geschikt</u> is voor u.</div>
                                <div class="col-md-12">Denk bijv. aan de werklocatie, werktijden, verwachte duur, benodigde kennis en kunde, benodigde persoonlijke eigenschappen, benodigde gereedschappen en voertuigen.</div>
                                <div class="col-md-12">Het is goed om hierover eerst wat vragen te stellen.</div>
                                <div class="col-md-12">Misschien is het handig om hierover eerst een persoonlijk gesprek met de projecteigenaar te houden.</div>
                                <div class="col-md-12"><b><i>Typ uw vraag hieronder in of probeer een persoonlijk gesprek af te spreken:</b></i></div>
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
                                <button id="inquire" name="inquire" value="inquire" type="submit" class="btn btn-primary btn-lg">Vraag versturen</button>
                            </div>
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <input type="hidden" name="applicant_id" value="{{ Auth::guard('web')->user()->id }}">
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

