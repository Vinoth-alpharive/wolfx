<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adminwallet extends Model
{
    protected $table = 'adminwallet';
    protected $connection = 'mysql2';

    public static function admincreditAmount($currency, $amount, $commission,$type = NULL)
    {
        $adminbalnce = Adminwallet::where([['currency', '=',$currency]])->first();
        if($adminbalnce) {
            $total = ncAdd($amount, $adminbalnce->balance, 8);
            $commission1 = ncAdd($commission, $adminbalnce->commission, 8);
            $adminbalnce->balance = $total;
            $adminbalnce->commission = $commission1;
            $adminbalnce->instant_type = $type;
            $adminbalnce->updated_at = date('Y-m-d H:i:s',time());
            $adminbalnce->save();
            return $adminbalnce;
        } else {        	
            Adminwallet::insert(['currency' => $currency, 'balance' => $amount, 'commission' => $commission, 'instant_type' => $type, 'created_at' => date('Y-m-d H:i:s',time()), 'updated_at' => date('Y-m-d H:i:s',time())]);
        }
    }



}
