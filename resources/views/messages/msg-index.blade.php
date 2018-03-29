@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-6">
            <h2>{{$msg_type}}</h2>
        </div>        

        <table class="table table-responsive table-striped">
            <thead>
                @if ($msg_type == "Verzonden berichten")
                    <th>Naar</th>
                @else
                    <th>Van</th>
                @endif
                
                <th>Onderwerp</th>
                <th>Datum</th>
            </thead>
            
            @foreach ($messages as $msg)
                <tr>

                    @if ($msg_type == "Verzonden berichten")
                        @if ($msg->is_read)
                            <td>
                        @else
                            <td style="background-color:pink;">                            
                        @endif                        
                                <a href="/messages/msg-show/{{$msg->id}}">{{$msg->recipient()->first()->firstname . " " . $msg->recipient()->first()->lastname}}</a>
                            </td>
                    @else
                        @if ($msg->is_read)
                            <td>
                        @else
                            <td style="background-color:pink;">                            
                        @endif
                                <a href="/messages/msg-show/{{$msg->id}}">{{$msg->sender()->first()->firstname . " " . $msg->sender()->first()->lastname}}</a>
                            </td>
                    @endif
                    
                    @if ($msg->is_read)
                        <td>
                    @else
                        <td style="background-color:pink;">                            
                    @endif
                            <a href="/messages/msg-show/{{$msg->id}}">{{$msg->subject}}</a>
                        </td>

                    @if ($msg->is_read)
                        <td>
                    @else
                        <td style="background-color:pink;">                            
                    @endif
                            <a href="/messages/msg-show/{{$msg->id}}">{{$msg->created_at}}</a>
                        </td>
                </tr>
            @endforeach
        </table>
    </div>

</div>

@endsection



