@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="form-group">
        <div class="card">
          <div class="card-header">  
            <h4>Start een project</h4>                      
          </div>
          <form class="form-group" method="POST" action="/projects">
            {{csrf_field()}}
            <div class="form-group">
              <label for="name ">Project naam:</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>            
            <div class="form-group">
              <label for="description">Beschrijving van het project:</label>
              <input type="text" class="form-control" id="description" name="description" required>
            </div>            
            <div class="form-group">
              <label for="start_date">Start van het project</label>
              <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
              <label for="due_date">deadline van het project</label>
              <input type="date" class="form-control" id="due_date" name="due_date" required>
            </div>
            <button type="submit" class="btn btn-default">Start project</button>
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



