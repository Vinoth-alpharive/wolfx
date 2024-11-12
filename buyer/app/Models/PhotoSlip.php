<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoSlip extends Model
{
    protected $table = 'photo_slip';

    protected $fillable = ['id','purchase_id','slip_name','created_at','updated_at'];
}
