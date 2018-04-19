<?php

namespace App\Http\Controllers;
use App\User;
use App\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{

	public function review(User $user)
   	{
   		$rating = DB::table('reviews')
        ->where('rated_user_id', '=', $user->id)
        ->avg('rating');
      
      return view('users.review', compact('user', 'rating'));
   	}

    public function storeOrUpdateRating(User $user)
   	{	
		  $rating_user_id = request('rating_user_id');
		  $rated_user_id = request('rated_user_id');
      $alreadyReviewd = Review::where('rating_user_id', $rating_user_id)->where('rated_user_id', $rated_user_id)->get();
		  if ($alreadyReviewd->count() < 1 && $rating_user_id != $rated_user_id ) {

        $this->validate(request(),[
            'rated_user_id',
            'rating_user_id',
            'rating'
        ]);
        $newRating = Review::create(request([
            'rated_user_id',
            'rating_user_id',
            'rating'
	     ]));
   		 $rating = DB::table('reviews')
      	->where('rated_user_id', '=', $user->id)
      	->avg('rating');
     		
   		return view('users.review', compact('user', 'rating'));
		}
   	elseif ($alreadyReviewd->count() >= 1 && $rating_user_id != $rated_user_id ){

      $this->validate(request(),[
      	'rated_user_id',
      	'rating_user_id',
      	'rating'
      	]);

      $updated = Review::where('rating_user_id', $rating_user_id)->where('rated_user_id', $rated_user_id)->update(request([
        'rated_user_id',
      	'rating_user_id',
      	'rating'
      	]));

      $rating = DB::table('reviews')
      	->where('rated_user_id', '=', $user->id)
      	->avg('rating');
    
      return view('users.review', compact('user', 'rating'));
     	} 
      else {
        echo "pech gehad";
		   }
		}
   	}
   	
    
