<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Countries;
class Bank extends Model
{
    protected $table = 'user_bank';
    protected $connection = 'mysql2';
    
    public function user() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
	public function userCountryDetails() {
	return $this->belongsTo('App\Models\Countries', 'country', 'id');
	
	}
}
