@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="form-group">
        <div class="card">
          <div class="card-header">  
            <h4>Creeer een competentie</h4>                      
          </div>
          <form class="form-group" method="POST" action="/admin/update_competences">
            {{csrf_field()}}
            <div class="form-group">
              <label for="competence">Creëer competentie:</label>
              <input type="text" class="form-control" id="competence" name="competence" required>
            </div>
             <div class="form-group">
              <label for="description">geef een bescrijving van de competentie:</label>
              <textarea type="text" class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-default">Creeer</button>
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
          <div class="row">
            <div class="col-md-12">
              <form method="POST" action="/admin/delete_competences">{{csrf_field()}}
                <table class="table table-striped col-md-12">
                  <tr>
                    <th>Delete competentie</th>
                  </tr>
                  @foreach ($competences as $competence)
                    <tr>
                      <td>
                        <button type="submit" name='competence' value='{{ $competence->id }}' class="btn btn-block float-right" > {{$competence->competence}}</button>
                      </td>
                    </tr>
                  @endforeach
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

