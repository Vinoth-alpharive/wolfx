<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    
protected $table = 'subscriber';
protected $connection = 'mysql2';

       protected $fillable = [
        'email'
    ];
     
}
