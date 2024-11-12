<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Coinuser;
use App\Models\AffilateCommission;
use App\Models\UserWallet;

class AffliateTransaction extends Model
{

	protected $connection = 'mysql2';
	protected $table ='affliate_transaction';

    public static function affliate_transaction($userid,$amount,$type){         
		$users 		 = Coinuser::on('mysql2')->where('id',$userid)->first(); 
		$refcode	 = $users->parent_id;  // myself code  
		$commissions = AffilateCommission::get();  

		if(count($commissions) > 0)
		{ 
			foreach($commissions as $commission) { 
              $coin = $commission->coin;             
              if($refcode != ''){
				
				$referuser = Coinuser::where('referral_id',$refcode)->first(); //check parent id 

				if($referuser){   
					if($type == 'deposit'){
						$dbcommission = $commission->deposit;
						if($commission->reward_type == 'fixed'){
							$commission_affilate = $commission->deposit;
						}else{
							$calculate  = bcdiv(sprintf('%.10f',$dbcommission),100,8);
							$commission_affilate = bcmul(sprintf('%.10f',$amount) ,sprintf('%.10f',$calculate),8);
						}
						
					}elseif($type == 'trade'){ 
						$dbcommission = $commission->trade;
						$calculate  = bcdiv(sprintf('%.10f',$dbcommission),100,8);
						$commission_affilate = bcmul(sprintf('%.10f',$amount) ,sprintf('%.10f',$calculate),8);

					}elseif($type == 'register'){ 
						$dbcommission = $commission->register;
						$commission_affilate = $dbcommission;
					}else{
						return 'Invalid type';
					}
					
	          if($commission_affilate  > 0)
	          {
	  				$uid = $referuser->id;	  				
	  				$reason = 'Generation '.$commission->generation.' affiliate commission';
	  				$inserid = self::CreateTransaction($uid,$userid,$coin,$reason,$commission_affilate,$type);
	  				UserWallet::creditAmount($uid, $coin, $commission_affilate,8,'affiliate',$reason,$inserid); 
	  				UserWallet::rewardCreditAmount($uid, $coin, $commission_affilate,8); 
	          } 
				}else { 
               break;
				} 
				$refcode = $referuser->parent_id;  
         	}
               else{
                 break;
               } 
            }
      }
        return true;
    }

    public static function CreateTransaction($uid,$from_id,$coin,$reason,$commission_affilate,$type)
    {
    	$affliate_transaction = new AffliateTransaction();
    	$affliate_transaction->uid  = $uid;
    	$affliate_transaction->from_id  = $from_id;
    	$affliate_transaction->coin  = $coin;
    	$affliate_transaction->reason  = $reason;
    	$affliate_transaction->type  = $type;
    	$affliate_transaction->commission  = $commission_affilate;
    	$affliate_transaction->created_at = date('Y-m-d H:i:s',time());
		$affliate_transaction->updated_at = date('Y-m-d H:i:s',time());
    	$affliate_transaction->save();
    	return $affliate_transaction->id;
    }

       public static function affliateHistory()
    {
    	$history = AffliateTransaction::orderBy('id', 'desc')->paginate(15);

    	return $history;
    }

     public function user() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }


}
