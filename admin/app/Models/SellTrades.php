<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellTrades extends Model
{
	protected $table = 'trades';
	protected $connection = 'mysql2';
    
    public static function sellTradesHistory($order_type,$tradepair)
    {
    	$history = SellTrades::on('mysql2')->where([['trade_type' ,'=','Sell'],['order_type', '=', $order_type],['pair', '=', $tradepair],['status','!=',0]])->orderBy('id', 'desc')->paginate(15);

    	return $history;
    }

    public static function sellTradesHistory_user($uid)
    {
        $history = SellTrades::on('mysql2')->where(['uid' => $uid,'trade_type' => 'Sell'])->orderBy('id', 'desc')->paginate(15);

        return $history;
    }
    public function user() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
    public function pair_get() {
        return $this->belongsTo('App\Models\Tradepair', 'pair', 'id');
    }
}
