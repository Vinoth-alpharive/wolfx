<?php
namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

trait Trc 
{	
	// create address
	public function trc_user_address_create(){
		$ch = curl_init();
		$params = array(
			"method" => "get_trx_address"
		);
		curl_setopt($ch, CURLOPT_URL, "http://165.227.166.121:8646");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
		$headers = array();
		$headers[] = "Content-Type : application/json";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		return json_decode($result, true);
	}

	public function trc_exec_addr_cUrl($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
		if (curl_errno($ch)) {
			$result = 'Error:' . curl_error($ch);
		} else {
			$result = curl_exec($ch);
		}
		curl_close($ch);
		return json_decode($result, true);
	}

	public function getTrcTransaction($address)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.trongrid.io/v1/accounts/".$address."/transactions/trc20");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$headers = array();
		$headers[] = "Content-Type : application/json";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		return json_decode($result, true);
	}

	public function convertTrc($amount)
	{
		return $amount / 1000000;
	}

	public function convertTrcAmount($amount)
	{
		return $amount * 1000000;
	}

	public function sendTrcTransaction($toAddress, $pvtk, $amount, $contract, $fee_limit)
	{
		$ch = curl_init();
		$params = array(
			"method" => "send_trc",
			"pvtk" => $pvtk,
			"contract" => $contract,
			"amount" => display_format($amount,0),
			"fee_limit" => $fee_limit,
			"to_address" => $toAddress
		);
		curl_setopt($ch, CURLOPT_URL, "http://165.227.166.121:8647");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
		$headers = array();
		$headers[] = "Content-Type : application/json";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close($ch);
		return json_decode($result);
	}
}
?>