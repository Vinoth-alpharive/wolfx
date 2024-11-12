<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellRequest extends Model
{
    protected $connection = 'mysql2';
    protected $table = "sell_request";
}
