<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminTransactions extends Model
{

	protected $table ='admin_transactions';


  public static function CreateTransaction($uid,$type,$coin, $amount,$price,$quantity,$value,$fee,$commission,$remarks=null,$trade_type=null,$tradeid=null){
        if($commission > 0){
            $trans = new AdminTransactions();
            $trans->uid = $uid;
            $trans->coin = $coin;
            $trans->type = $type;
            $trans->trade_type = $trade_type;
            $trans->tradeid = $tradeid;
            $trans->amount = $amount;
            $trans->price = $price;
            $trans->quantity = $quantity;
            $trans->value = $value;
            $trans->fee = $fee;
            $trans->commission = $commission;
            $trans->remarks = $remarks;
            $trans->created_at = date('Y-m-d H:i:s',time());
            $trans->updated_at = date('Y-m-d H:i:s',time());
            $trans->save();
            return true;
        } else {
            return true;
        }
        
    }

}
