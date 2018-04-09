@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('iets over mezelf') }}
                </div>
                <div class="card-body">  
                    <form class="form-group float-left" method="POST" action="{{route('users.detach_hobbies', $user)}}">
                        @foreach ($hobbies_selected as $hobby_selected)
                            {{csrf_field()}}
                            <button type="submit" name='hobby' value='{{ $hobby_selected->id }}' data-toggle="tooltip" class="btn btn-default float-left ml-1 mb-1" >{{ $hobby_selected->hobby }}</button>
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
                    <form class="form-group col-md-12" method="POST" action="{{route('users.store_hobbies', $user)}}">
                        {{csrf_field()}}                   
                        <div class="form-group col-md-12 row">
                            <label for="hobby" class="col-md-3 col-form-label text-md-right">{{ __('Voeg een hobby toe') }}</label>
                            <div class="col-md-7">
                                <input list="hobbies" id="hobby" type="text" class="form-control" name="hobby">
                                    <datalist id="hobbies"> 
                                        @foreach($hobbies as $hobby)
                                            <option>{{$hobby->hobby}}</option>
                                        @endforeach
                                    </datalist>
                                @if ($errors->has('hobby'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-success ml-auto float-right" role="button">
                                    {{ __('Sla op') }}
                                </button> 
                            </div>
                        </div>
                    </form>
                        
                    <!-- Terug naar avatar -->
                    <div class="card-footer">
                        <div class="col-md-12">
                            <form class="col-md-2 float-left" method="GET" action="/users/{{Auth::user()->id}}/edit_avatar"> 
                                <button type="submit" class="btn btn-primary ml-auto" role="button">
                                    {{ __('Vorige') }}
                                </button> 
                            </form>
                    <!--  Naar volgende -->  
                            <form class="col-md-2 float-right" method="GET" action="/users/{{Auth::user()->id}}/edit_competences">
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
                         


                         