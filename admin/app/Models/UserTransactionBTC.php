<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OverallTransaction;

class UserTransactionBTC extends Model
{
    protected $table = 'user_transaction_btcs';
    protected $connection = 'mysql3';


    public static function AddTransaction($uid,$type,$credit,$debit,$balance,$oldbalance,$remark,$insertid,$update_from="admin"){
    	OverallTransaction::AddTransaction($uid,'BTC',$type,$credit,$debit,$balance,$oldbalance,$remark,$update_from,$insertid);
		$trans = new UserTransactionBTC();
		$trans->uid = $uid;
		$trans->type = $type;
		$trans->credit = $credit;
		$trans->debit = $debit;
		$trans->balance = $balance;
		$trans->oldbalance = $oldbalance;
		$trans->remark = $remark;
		$trans->updatefrom = $update_from;
		$trans->created_at = date('Y-m-d H:i:s',time());
		$trans->updated_at = date('Y-m-d H:i:s',time());
		$trans->save();
		return true;
    } 



}
