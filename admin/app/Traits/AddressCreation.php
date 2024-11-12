<?php 
namespace App\Traits;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\EvmClass;
use App\Traits\TrcClass;

trait AddressCreation {
	use EvmClass,TrcClass;

	public function userAddressCreation($id)
	{		
		$trxAddress = $this->createTrcAddress($id);
		$ethAddress = $this->create_user_evm($id);

		if(isset($ethAddress) && isset($trxAddress)){
			return 1;
		}
		else{
			return 0;
		}		
	}
}