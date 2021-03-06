@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-group">
                <div class="card">
                    <div class="card-header">  
                        <h4>Voeg studieervaring toe</h4>                      
                    </div>
                    <!-- Organization -->
                    <form class="form-group mt-3" method="POST" action="{{route('users.update_studyExperience', $user)}}">
                        {{csrf_field()}}
                        <input id="user_id" type="text" class="form-control d-none" name="user_id" value="{{ Auth::guard('web')->user()->id}}" required>
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Opleiding') }}</label>
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- Start date -->
                        <div class="form-group row">
                           <label for="start_date" class="col-md-3 col-form-label text-md-right">{{ __('Van') }}</label>
                            <div class="col-md-8">
                                <input id="start_date" type="date" class="form-control" name="start_date" value="" required>
                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- end date -->
                        <div class="form-group row">
                            <label for="end_date" class="col-md-3 col-form-label text-md-right">{{ __('Tot') }}</label>
                            <div class="col-md-8">
                                <input id="end_date" type="date" class="form-control" name="end_date" value="">
                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- level -->
                        <div class="form-group row">
                            <label for="level" class="col-md-3 col-form-label text-md-right">{{ __('Opleidingsniveau') }}</label>
                            <div class="col-md-8">
                                <select id="level" type="text" class="form-control" name="level" value="{{ $user->level }}">
                                    <option value="7">Post-Doc</option>
                                    <option value="6">MBA</option>
                                    <option value="5">WO</option>
                                    <option value="4" selected>HBO</option>
                                    <option value="3">MBO</option>
                                    <option value="2">VO</option>
                                    <option value="1">Cursus</option>
                                </select>
                                @if ($errors->has('level'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- diploma -->
                        <div class="form-group row">
                            <label for="diploma" class="col-md-3 col-form-label text-md-right">{{ __('Diploma/certifcaat') }}</label>
                            <div class="col-md-8">
                                <label class="">
                                    <input name="diploma" type="checkbox" value="Ja">Ja
                                </label><br />
                                <label class="">
                                  <input name="diploma" type="checkbox" value="Nee">Nee
                                </label>
                                @if ($errors->has('diploma'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('diploma') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-11 text-right">
                            <button type="submit" class="btn btn-success" role="button">
                                {{ __('Sla op') }}
                            </button> 
                        </div>
                    </form>
                    <!-- back to workexperience -->
                    <div class="col-md-12">
                        <form class="col-md-2 float-left" method="GET" action="/users/{{Auth::user()->id}}/edit_workExperience"> 
                            <button type="submit" class="btn btn-primary ml-auto" role="button">
                                {{ __('Vorige') }}
                            </button> 
                        </form>
                        <!-- forward to project experience -->
                        <form class="col-md-2 float-right" method="GET" action="/users/{{Auth::user()->id}}/edit_projectExperience"> 
                            <button type="submit" class="btn btn-primary ml-auto" role="button">
                                {{ __('Volgende') }}
                            </button> 
                        </form>                                        
                    </div>
                    <div class="card-header">  
                        <h5>Studiervaring</h5>                      
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <table class="table table-striped col-md-12">
                            <tr>
                                <th>Opleiding</th>
                                <th>Niveau</th>                
                                <th>Begonnen op</th>                                
                                <th>Beindigd op</th>
                                <th>Diploma</th>               
                            </tr>
                            @foreach ($studyExperiences as $studyExperience)
                            <tr>
                                <td>{{$studyExperience->name}}</td>
                                <td>@switch($studyExperience)
                                        @case($studyExperience->level == 1)
                                         <span>Cursus</span>
                                        @break
                                        @case($studyExperience->level == 2)
                                         <span>VO</span>
                                        @break
                                        @case($studyExperience->level == 3)
                                             <span>MBO</span>
                                        @break
                                        @case($studyExperience->level == 4)
                                             <span>HBO</span>
                                        @break
                                        @case($studyExperience->level == 5)
                                             <span>WO</span>
                                        @break
                                        @case($studyExperience->level == 6)
                                             <span>MBA</span>
                                        @break
                                        @case($studyExperience->level == 7)
                                             <span>Post-doc</span>
                                        @break
                                    
                                        @default
                                            <span></span>
                                    @endswitch
                                </td>
                                <td>{{$studyExperience->start_date}}</td>
                                @if($studyExperience->end_date == null)
                                <td> Nog bezig </td>
                                @else
                                <td> {{$studyExperience->end_date}}</td>
                                @endif
                                <td>{{$studyExperience->diploma}}</td>
                            </tr>
                            @endforeach    
                        </table>
                    </div>
                </div>
                <!-- Not in function right now -->
                <div class="d-none">
                    <!-- reference  -->
                    <form class="form-group" method="POST" action="/">
                        <div class="card-header">  
                            <h5>Voeg referentie toe</h5>                      
                        </div>
                        <div class="form-group row mt-4">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Naam') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <!-- number -->
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Telefoonnummer') }}</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="" required>
                                @if ($errors->has('phone'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>                    
                        <!-- email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="" required>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection