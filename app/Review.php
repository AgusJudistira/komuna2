<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
        protected $fillable = [
        	'id',
			'rated_user_id',
            'rating_user_id',
			'rating',
            'rating',
            'like',
			'review'
    ];
     
    public function Review()
    
    {
        return $this->hasOne(User::class);
    }
}
