<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SwapHistory extends Model
{	
	protected $connection = 'mysql2';
    protected $table = 'swaphistorys';  
    
    public function user() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
    
    public function pair_get() {
        return $this->belongsTo('App\Models\Tradepair', 'pair', 'id');
    }

}

