<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserLogin extends Model
{
	protected $connection = 'mysql2';
		protected $table = 'user_login'; 
 public static function attemptSave($data)
    {
    	UserLogin::create($data);
    	return true;
    }

    public static function getAllDetails()
    {
    	$details = UserLogin::on('mysql2')->orderBy('id', 'desc')->paginate(15);

    	return $details;
    }

    public static function activitySearch($status, $input){

	    $result = UserLogin::with('User')
	    ->whereHas('User', function($query) use ($input)
    	{
        	$query->where('first_name', 'LIKE', '%'.$input.'%');
            $query->where('last_name', 'LIKE', '%'.$input.'%');
			$query->orWhere('email', 'LIKE', '%'.$input.'%');
			$query->orWhere('login_ip', 'LIKE', '%'.$input.'%');

    	})
    	->orderBy('updated_at', 'desc')->paginate(50);

        return $result;
    }


    public static function isLogged()
    {
        $details = User::on('mysql2')->whereDate('updated_at', Carbon::today())->where('is_logged',1)->orderBy('updated_at', 'desc')->paginate(15);
        return $details;
    }



public function scopeSearch($query)
{
    $keyword = \Request::get('search');
    $city = \Request::get('searchplace');
    if (isset($keyword) || !is_null($keyword)) {
        $terms = explode(' ', $keyword); // Array of searchstrings
        foreach ($terms as $term) {
            $query = $query->whereHas('city', function ($q) use ($city) {
                $q->where('place_of_employment_city_id', '=', $city)->with('city');

            });

            return $query->where('post_name', 'LIKE', "%" . $term . "%");
        }
    }
    return $query;
}




  //relationship
  
	 public function User()
	{
	  return $this->belongsTo('App\Models\User', 'user_id', 'id');
	}
}