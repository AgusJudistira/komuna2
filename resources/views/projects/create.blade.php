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
                <input type="text" class="form-control" id="description" name="description" required>
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
                <input type="date" class="form-control" id="due_date" name="due_date" required>
              </div>
            </div>
            <br>
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary btn-lg">Start project</button>
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



