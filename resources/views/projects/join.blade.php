@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="form-group">
        <div class="card">
          <div class="card-header">  
          <h4>Aanmelden voor het project <b>{{$project->name}}</b>.</h4>                      
          </div>
        <form class="form-group" method="GET" action="/messages/send/{{$project->id}}">
            {{csrf_field()}}
            <div class="col-md-8">
                <p>U, <b><i>{{Auth::guard('web')->user()->firstname . " " . Auth::guard('web')->user()->lastname}}</i></b>, bent van plan om zich aan te melden om mee te werken aan het project: <b><i>{{ $project->name }}</i></b>.
                <p>Klik op <span class="bg-primary" style="color: white;">Aanmelding versturen</span> om u aan te melden.</p>
                <p>Een bericht naar de projecteigenaar(s) zal verstuurd worden. </p>
                <p>Na goedkeuring van een projecteigenaar zult u aan het project gekoppeld worden.</p>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-2">                                    
                    <button id="annuleren" name="annuleren" value="annuleren" type="submit" class="btn btn-info btn-lg">Annuleren</button>
                </div>
                <div class="col-md-3">                                    
                    <button id="invoeren" name="versturen" value="versturen" type="submit" class="btn btn-primary btn-lg">Aanmelding versturen</button>
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
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection



