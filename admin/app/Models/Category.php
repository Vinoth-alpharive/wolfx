<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $connection = 'mysql2';   
    protected $table = "category";
}