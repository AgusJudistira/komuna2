@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="form-group">
				<div class="card">
					<div class="card-header">  
						<h4>Voeg competenties toe</h4>                      
					</div>
					<!-- Added Competences -->
					<form class="form-group float-left ml-1" method="POST" action="{{route('users.detach_competences', $user)}}">
						@foreach ($competences_selected as $competence_selected)
						{{csrf_field()}}
						<button type="submit" name='competence' value='{{ $competence_selected->id }}' data-toggle="tooltip" title="{{ $competence_selected->description }}"class="btn btn-default float-left ml-1 mb-1" >{{ $competence_selected->competence }}</button>
						@endforeach
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
					<!-- Selectie mogelijke competenties -->
					<form class="form-group row" method="POST" action="{{route('users.update_competences', $user)}}">
						{{csrf_field()}}
						<label for="competence" class="col-md-3 col-form-label text-md-right">{{ __('Selecteer competenties:') }}</label>
						<div class="form-group col-md-7 row">
							<select name="competences_select[]" class="form-control" size="12" multiple>
								@foreach ($competences as $competence)
									<option name='competence' value='{{ $competence->id }}' data-toggle="tooltip" title="{{ $competence->description }}" >{{ $competence->competence }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-2">
							<button type="submit" class="btn btn-success">Voeg toe</button>
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
					<!-- Back to avatar selection-->
					<div class="card-footer">
						<div class="col-md-12 ">
							<form class="col-md-2 float-left" method="GET" action="/users/{{Auth::user()->id}}/edit_hobbies"> 
								<button type="submit" class="btn btn-primary ml-auto" role="button">
									{{ __('Vorige') }}
								</button> 
							</form>
							<!--  Forward to skills selection -->
							<form class="col-md-2 float-right" method="GET" action="/users/{{Auth::user()->id}}/edit_skills"> 
								<button type="submit" class="btn btn-primary ml-auto" role="button">
									{{ __('Volgende') }}
								</button> 
							</form>
						</div>
					</div>
                </div>                 
             </div>
         </div>
     </div>
 </div>
@endsection

