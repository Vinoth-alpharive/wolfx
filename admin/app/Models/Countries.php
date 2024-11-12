<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
	protected $connection = 'mysql2';
    protected $table = 'countries';

    public static function index()
    {      
        $Countries = Countries::on('mysql2')->orderBy('id','desc')->paginate(10);  

        return $Countries;

    }

    public static function edit($id)
    {

       $Country =Countries::on('mysql2')->where('id',$id)->first();
      

       return $Country;

    }


}
