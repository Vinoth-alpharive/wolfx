<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Staking_user_deposit extends Model
{	
	protected $connection = 'mysql3';
    protected $table = 'staking_user_deposit'; 


     public function sta_setting()
    {
      return $this->belongsTo('App\Models\Staking_setting', 'stak_id', 'id');

    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
   


}
