<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffilateCommission extends Model
{
    protected $connection = 'mysql2';
    protected $table ='affilate_commission';


    public static function index()
    {
    	$commission = AffilateCommission::paginate(10);

    	return $commission;
    }

    public static function coindetails($coin)
    {
        $commission = AffilateCommission::where('source', $coin)->first();
        return $commission;
    }

    public static function edit($id)
    {
    	$commission = AffilateCommission::where('id', $id)->first();

    	return $commission;
    }

    public static function commissionUpdate($request)
    {
    	$commission = AffilateCommission::where('id', $request->id)->first();
        $commission->coin  = $request->coin_name;
        $commission->register  = $request->register;
        $commission->deposit  = $request->deposit ? $request->deposit : 0;
        $commission->trade = $request->trade ? $request->trade : 0; 
        $commission->title = $request->title ? $request->title : 0; 
        $commission->save();

        return true;   
    }


  }
