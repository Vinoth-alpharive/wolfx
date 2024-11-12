<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    
    protected $connection = 'mysql2';
    protected $table = 'purchase_history';

    public function slipClip(){
        return $this->belongsTo('App\Models\PhotoSlip','id','purchase_id');
    }
}