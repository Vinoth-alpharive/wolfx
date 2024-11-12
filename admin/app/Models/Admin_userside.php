<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
 
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Model;

class Admin_userside extends Authenticatable 
{	
	protected $table = "admin";
	protected $connection = "mysql2";
}
	