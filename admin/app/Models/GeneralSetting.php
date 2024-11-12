<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $table = 'general_settings';
    protected $connection = 'mysql2';
    protected $fillable = ['id','title','lang','key','description','image','status','created_at','updated_at'];


}
