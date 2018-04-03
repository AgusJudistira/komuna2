@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="form-group">
        <div class="card">
          <div class="card-header">  
            <h4>Start een project</h4>                      
          </div>
          <form class="form-group" method="POST" action="/projects">
            {{csrf_field()}}
            <br>
            <div class="form-group row">
              <div class="col-md-3 text-right">
                <label for="name ">Project naam:</label>
              </div>
              <div class="col-md-8 text-left">
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
            </div> 
            <div class="form-group row">
              <div class="col-md-3 text-right">
                <label for="description">Beschrijving van het project:</label>
              </div>
              <div class="col-md-8">                
                <textarea class="form-control" rows="5" id="description" name="description" type="text"></textarea>
              </div>            
            </div>
            <div class="form-group row">
              <div class="col-md-3 text-right">
                <label for="start_date">Start van het project</label>
              </div>
              <div class="col-md-8 text-left">
                <input type="date" class="form-control" id="start_date" name="start_date" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-3 text-right">
                <label for="due_date">Deadline van het project</label>
              </div>
              <div class="col-md-8 text-left">
                <input type="date" class="form-control" id="due_date" name="due_date">
              </div>
            </div>
            <br>
            <div class="form-group row">
              <div class="col-md-3 text-right">Selecteer de benodigde competenties voor dit project (houd CTRL vast om meer dan een te selecteren):</div>

              <div class="col-md-8">
                  <select name="competences_select[]" class="form-control" size="10" multiple>
                    @foreach ($competences as $competence)
                      <option name='competence' value='{{ $competence->id }}'>{{ $competence->competence }}</option>
                    @endforeach
                  </select>
              </div>
            </div>
            
            <div class="col-md-12 row">
              <div class="col-md-4"></div>
              <div class="col-md-4">
                <button name="cancel" value="cancel" type="submit" class="btn btn-primary btn-lg">Annuleren</button>
              </div>  
              <div class="col-md-4">
                <button name="start" value="start" type="submit" class="btn btn-primary btn-lg">Start project</button>
              </div>
            </div>
        				
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

@endsection



