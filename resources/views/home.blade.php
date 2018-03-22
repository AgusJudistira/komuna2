@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Persoonlijke startpagina van <h5>{{ Auth::guard('web')->user()->firstname . " ". Auth::guard('web')->user()->lastname}}</h5></div>

                <div class="card-body">
                    <h5><a href="organizations">Organisatie aanmaken</a></h5>
                    <h5><a href="/users/{{Auth::guard('web')->user()->id}}">Profiel wijzigen</a></h5>
                    <h5><a href="/projects">Projecten</a></h5>
                    <h5><a href="/projects/create">Een project starten</a></h5>   
                    
                    {{--  @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif  --}}
                </div>
                <div class="card-footer">
                    <form class="form-group" method="POST" action="/messages/msg-index">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">Verzonden berichten:</div>
                            <div class="col-md-1">{{ $sent_messages }}</div>
                            <div class="col-md-4"><button id="sent" name="message_type" value="sent" type="submit" class="btn btn-primary btn-lg">Bekijken</button></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Ongelezen berichten:</div>
                            <div class="col-md-1">{{ $unread_messages }}</div>
                            <div class="col-md-4"><button id="unread" name="message_type" value="unread" type="submit" class="btn btn-primary btn-lg">Bekijken</button></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">Ingekomen berichten:</div>
                            <div class="col-md-1">{{ $incoming_messages }}</div>
                            <div class="col-md-4"><button id="incoming" name="message_type" value="incoming" type="submit" class="btn btn-primary btn-lg">Bekijken</button></div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
