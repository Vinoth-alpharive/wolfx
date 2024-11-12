<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trades extends Model
{
	protected $table = 'trades';
	protected $connection = 'mysql2';
    
    public static function pendingTradeHistory($tradetype='Buy',$ordertype=1,$tradepair)
    {
        if($tradetype == 'all' && $ordertype == 'all' && $tradepair=='all'){
            $history = Trades::on('mysql2')->where([['status','!=',0]])->orderBy('id', 'desc')->paginate(15);
        } else if($tradetype != 'all' && $ordertype == 'all' && $tradepair=='all'){
            $history = Trades::on('mysql2')->where([['trade_type' ,'=','Buy'],['order_type', '=', $order_type],['pair', '=', $tradepair],['status','!=',0]])->orderBy('id', 'desc')->paginate(15);
        }
    	$history = Trades::on('mysql2')->where([['trade_type' ,'=','Buy'],['order_type', '=', $order_type],['pair', '=', $tradepair],['status','!=',0]])->orderBy('id', 'desc')->paginate(15);

    	return $history;
    }

     public static function buyTradesHistory_user($uid)
    {
        $history = BuyTrades::on('mysql2')->where(['uid' => $uid,'trade_type' => 'Buy'])->orderBy('id', 'desc')->paginate(15);

        return $history;
    }

    public static function TradesHistory_user($uid)
    {
        $history = BuyTrades::on('mysql2')->where(['uid' => $uid])->orderBy('id', 'desc')->paginate(15);

        return $history;
    }


    public function user() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
    public function pair_get() {
        return $this->belongsTo('App\Models\Tradepair', 'pair', 'id');
    }
}
