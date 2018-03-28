@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="form-group">
        <div class="card">
        <form class="form-group" method="GET" action="/projects/send_join_request/{{$project->id}}">
            {{csrf_field()}}
            <div class="card-header">  
              <h4>Aanmelden voor het project <b>{{$project->name}}</b>.</h4>                      
            </div>
            <div class="card-body">                    
              <div class="row">
                  <div class="col-md-12">U, <b><i>{{Auth::guard('web')->user()->firstname . " " . Auth::guard('web')->user()->lastname}}</i></b>, bent van plan om zich aan te melden om mee te werken aan het project: <b><i>{{ $project->name }}</i></b>.</div>
                  <div class="col-md-12">Klik op <span class="bg-primary" style="color: white;">Aanmelding versturen</span> om u aan te melden.</div>
                  <div class="col-md-12">Een bericht naar de projecteigenaar(s) zal verstuurd worden. </div>
                  <div class="col-md-12">Na goedkeuring van een projecteigenaar zult u aan het project gekoppeld worden.</div>
              </div>
              <div class="row">
                  <div class="col-md-12"><b><i>U kunt hieronder eventueel een persoonlijke bericht intypen:</b></i></div>
                  <textarea class="form-control" row="5" name="user_message"></textarea>
              </div>  
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-2">                                    
                        <button id="cancel" name="cancel" value="cancel" type="submit" class="btn btn-info btn-lg">Annuleren</button>
                    </div>
                    <div class="col-md-3">                                    
                        <button id="apply" name="apply" value="apply" type="submit" class="btn btn-primary btn-lg">Aanmelding versturen</button>
                    </div>           
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
                </div >
            </div>
          </form>
        </div>
      </div>        
    </div>
  </div>
</div>

@endsection



