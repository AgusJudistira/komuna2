@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-8">
            <h3>Vrijwilligers vinden</h3>
        </div>
        <div class="col-md-4 text-right">
           
        </div>

        <table class="table table-striped">
            <thead>
                <th>Naam</th>                
                                               
                <th>Woonplaats</th>                
            </thead>
                @foreach ($users as $user)
                    @if ($user->id != Auth::guard('web')->user()->id)
                <tr>
                    <td><a href="/users/{{$user->id}}/show">{{$user->firstname}} {{$user->lastname}}</a>
                    <td><a href="/users/{{$user->id}}/show">{{$user->city}}</a></a></td>
                    
                </tr> 
                    @endif
                @endforeach
        </table>
    </div>

</div>

@endsection