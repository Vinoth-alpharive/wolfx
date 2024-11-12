<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminTransactions extends Model
{

	protected $connection = 'mysql2';
	protected $table ='admin_transactions';


    public static function Createtransaction($uid,$type,$amount,$quantity,$value,$fee,$commission,$currency)
    {
          $transaction = new AdminTransactions;

          $transaction->uid = $uid;
          $transaction->currency = $currency;
          $transaction->type = $type;
          $transaction->price = $amount;
          $transaction->quantity = $quantity;
          $transaction->value = $value;
          $transaction->fee = $fee;
          $transaction->commission = $commission;
          $transaction->save();
          return $transaction;
     
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'uid', 'id');

    }

}
