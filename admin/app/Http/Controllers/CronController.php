<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Libraries\Demon;
use App\Traits\XrpClass;

class CronController extends Controller
{ 
	use XrpClass;   
	public function sendtest(){
		$username = env('RPC_USERNAME','gbc5846rpc');
		$psw = env('RPC_PASSWORD','pVInoJnSs8K0i645Jasi');
		$ip = env('RPC_IP','127.0.0.1');
		$demonport = env('RPC_PORT','9668');
		
		$myFlash = new Demon($username,$psw,$ip,$demonport);
		$fromaddress = '';
		$toaddress = '';
		$amount = "1";
		$result = $myFlash->getnewaddress('KoinPair');		
		//$result = $myFlash->getblockchaininfo();		
		dd($result);
		
    }   
	public function Xrptest(){				
		$result = $this->xrp_admin_address_create();		
		dd($result);		
    }
}
