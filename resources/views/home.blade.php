@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Dashboard</div>

                <div class="card-body">
                    <h5><a href="organizations">Organisatie aanmaken</a></h5>
                    {{--  @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif  --}}

                    You are logged in as {{ Auth::guard('web')->user()->firstname . " ". Auth::guard('web')->user()->lastname}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
