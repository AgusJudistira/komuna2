@extends('layouts.app')
@section('content')



<br /><br /><br /><br /><br /><br />
<div class="float-left">
    <div class="stars">
        @if($rating < 0.5 )
        <span class="star mr-2"></span>  
            @elseif($rating >= 0.5 && $rating < 1)
        <span class="star half mr-2"></span>
                @else($rating > 1 )
        <span class="star on mr-2"></span>
        @endif
        @if($rating < 1.5 )
        <span class="star mr-2"></span>   
            @elseif($rating >= 1.5 && $rating < 2)
        <span class="star half mr-2"></span>    
                @else($rating >= 2 )
        <span class="star on mr-2"></span>
        @endif
   
        @if($rating < 2.5 )
        <span class="star mr-2"></span>
            @elseif($rating >= 2.5 && $rating < 2.9)
        <span class="star half mr-2"></span>
                @else($rating >= 2.9 )
        <span class="star on mr-2"></span>
        @endif

        @if($rating < 3.5 )
        <span class="star mr-2"></span>
            @elseif($rating >= 3.5 && $rating < 3.85)
        <span class="star half mr-2"></span>
                @else($rating >= 3.85 )
        <span class="star on mr-2"></span>
        @endif
    </div>

    <form method="POST" action="{{route('users.store_rating', $user)}}">
    {{csrf_field()}}
        <input type="hidden" value="{{Auth::user()->id}}" name="rating_user_id">
        <input type="hidden" value={{"$user->id"}} name=rated_user_id>
    
        <div class="rating">
            <span class="mr-5"><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label></span>
            <span class="mr-5"><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label></span>
            <span class="mr-5"><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label></span>
            <span class="mr-5"><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label></span>
        </div>
        <input type="submit" value="beoordeel" name="submit">
    </form>
</div>
@endsection
