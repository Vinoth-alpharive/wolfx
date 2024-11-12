<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Countries;
class UserBorrowHistory extends Model
{
    protected $table = 'borrow_history';
    protected $connection = 'mysql2';
    
    
}
