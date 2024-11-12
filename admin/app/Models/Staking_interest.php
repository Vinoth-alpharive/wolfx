<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staking_interest extends Model
{	
	protected $connection = 'mysql3';
    protected $table = 'staking_interest';   

	public function staking()
    {
      return $this->belongsTo('App\Models\Staking_user_deposit', 'stak_id','stak_id');
    } 
    public function user() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
   

}
