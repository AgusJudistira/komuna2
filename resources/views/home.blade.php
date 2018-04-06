@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="col-md-12 text-center" style="background-color:darkblue; color:white;"><h2>Dashboard</h2></div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Persoonlijke startpagina van <h5><a href="/users/{{Auth::user()->id}}/show">{{ Auth::guard('web')->user()->firstname . " ". Auth::guard('web')->user()->lastname}}</a></h5></div>

                <div class="card-body">
                    <h5><a href="organizations">Organisaties</a></h5>
                    <h5><a href="/users/{{Auth::guard('web')->user()->id}}/edit_personal">Profiel wijzigen</a></h5>
                    <h5><a href="/projects">Projecten</a></h5>                    
                    
                </div>
                <div class="card-footer">
                    <form class="form-group" method="GET" action="/messages/msg-index">
                        {{ csrf_field() }}
                        <div class="row">

                            @if ($sent_messages > 0)
                                <div class="col-md-4"><button id="sent" name="message_type" value="sent" type="submit" class="btn btn-success btn-lg">Verzonden berichten: {{ $sent_messages }}</button></div>
                            @endif

                            @if ($unread_messages > 0)
                                <div class="col-md-4"><button id="unread" name="message_type" value="unread" type="submit" class="btn btn-danger btn-lg">Ongelezen berichten: {{ $unread_messages }}</button></div>
                            @endif

                            @if ($incoming_messages > 0)
                                <div class="col-md-4"><button id="incoming" name="message_type" value="incoming" type="submit" class="btn btn-primary btn-lg">Ingekomen berichten: {{ $incoming_messages }}</button></div> 
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
