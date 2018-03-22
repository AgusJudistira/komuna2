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
                    
                    <p>Verzonden berichten: {{ $sent_messages }}</p>
                    <p>Ongelezen berichten: {{ $unread_messages }}</p>
                    <p>Ingekomen berichten: {{ $incoming_messages }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
