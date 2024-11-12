<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Countries;
class UserBorrowHInterest extends Model
{
    protected $table = 'borrow_interest';
    protected $connection = 'mysql2';
    
    
}
