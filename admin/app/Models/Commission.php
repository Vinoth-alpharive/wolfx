<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{

    protected $connection = 'mysql2';

    
    public static function index()
    {
    	$commission = Commission::on('mysql2')->paginate(20);

    	return $commission;
    }

    public static function coindetails($coin)
    {
        $commission = Commission::on('mysql2')->where('source', $coin)->first();
        return $commission;
    }

    public static function edit($id)
    {
    	$commission = Commission::on('mysql2')->where('id', $id)->first();

    	return $commission;
    }

    public static function commissionUpdate($request)
    {
  
    	$commission = Commission::on('mysql2')->where('id', $request->id)->where('source',$request->currency)->first();
		if($commission){
			$commission->withdraw  = $request->withdraw;
			$commission->min_deposit = $request->min_deposit;
			$commission->min_withdraw = $request->min_withdraw;
            $commission->perday_withdraw =$request->perday_withdraw;
            $commission->com_type = $request->com_type;
            $commission->is_deposit = $request->is_deposit;
            $commission->is_withdraw = $request->is_withdraw;
            $commission->is_swap =$request->is_swap;
            $commission->netfee = $request->netfee;
			$commission->save();
		}

        return true;   
    }
}
