@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Backend</div>

                <div class="card-body">
                    <div class="card-body">
                    <h5><a href="admin/edit_competences">Onderhoud Competenties</a></h5>                    
                    {{--  @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif  --}}
                </div>


                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as administrator {{ Auth::guard('admin')->user()->name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
