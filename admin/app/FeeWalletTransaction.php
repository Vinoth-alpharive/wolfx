<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeWalletTransaction extends Model
{
    public static function createTransaction($coin,$txid,$from,$to,$amount,$confirm=3,$time,$deposittype = null,$txtype='receive'){
        $tran = FeeWalletTransaction::where(['currency' => $coin,'txid' => $txid])->first();
        if(!$tran){
            $tran = new FeeWalletTransaction();
            $tran->currency = $coin;
            $tran->txtype = $txtype;
            $tran->txid = $txid;
            $tran->from_addr = $from;
            $tran->to_addr = $to;
            $tran->amount = $amount;            
            $tran->status = 2;
            if($deposittype != '')
            {
              $tran->network = $deposittype;

            }
            $tran->created_at = $time;
        }
        $tran->confirmation = $confirm;
        $tran->updated_at = date('Y-m-d H:i:s',time());
        $tran->save();         
        return $tran;
    }
}
