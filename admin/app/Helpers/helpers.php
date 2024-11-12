<?php

function display_format($number, $digit = 8, $format = NULL)
{
	if ($format == "") {
		$twocoin = sprintf('%.' . $digit . 'f', $number);
	} elseif ($format == 0) {
		$twocoin = number_format($number, $digit);
	} else {
		$twocoin = number_format($number, $digit, ",", ".");
	}
	return $twocoin;
}

function user($id)
{
	$user = App\User::on('mysql2')->where('id', $id)->first();

	return $user;
}
function username($id)
{
	$user = App\User::on('mysql2')->where('id', $id)->first();
	if ($user) {
		return $user->first_name . ' ' . $user->last_name;
	} else {
		return false;
	}

}
function currency($type)
{
	if ($type == 4) {
		$currency = 'USD';
	} else if ($type == 5) {
		$currency = 'TRY';
	} else {
		$currency = 'EUR';
	}
	return $currency;
}
function country()
{

	$countries = App\Models\Countries::on('mysql2')->get();

	return $countries;
}

function first_pair()
{
	$Tradepair = \App\Models\Tradepair::on('mysql2')->first();
	$pair = $Tradepair->coinone . '_' . $Tradepair->cointwo;

	return $pair;
}

function bank($id)
{
	$bank = App\Models\Bank::on('mysql2')->where('id', $id)->first();

	return $bank;
}
function list_coin()
{
	$coins = App\Models\Commission::on('mysql2')->select('source')->distinct()->get();
	return $coins;
}
function ncAdd($value1, $value2, $digit = 8)
{
	$value = bcadd(sprintf('%.10f', $value1), sprintf('%.10f', $value2), $digit);
	return $value;
}
function ncSub($value1, $value2, $digit = 8)
{
	$value = bcsub(sprintf('%.10f', $value1), sprintf('%.10f', $value2), $digit);
	return $value;
}
function ncMul($value1, $value2, $digit = 8)
{
	$value = bcmul(sprintf('%.10f', $value1), sprintf('%.10f', $value2), $digit);
	return $value;
}

function ncDiv($value1, $value2, $digit = 8)
{
	$value = bcdiv(sprintf('%.10f', $value1), sprintf('%.10f', $value2), $digit);
	return $value;
}
function ticketcount()
{
	$ticketcount = App\Models\Supportchat::on('mysql2')->where('admin_status', 0)->count();
	return $ticketcount;
}
function TransactionString($length = 60)
{
	$str = substr(hash('sha256', mt_rand() . microtime()), 0, $length);
	return $str;
}
function seoUrl($string)
{
	//Lower case everything
	$string = strtolower($string);
	//Make alphanumeric (removes all other characters)
	$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	//Clean up multiple dashes or whitespaces
	$string = preg_replace("/[\s-]+/", " ", $string);
	//Convert whitespaces and underscore to dash
	$string = preg_replace("/[\s_]/", "-", $string);
	return $string;
}
function get_client_ip()
{
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP')) {
		$ipaddress = getenv('HTTP_CLIENT_IP');
	} else if (getenv('HTTP_X_FORWARDED_FOR')) {
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	} else if (getenv('HTTP_X_FORWARDED')) {
		$ipaddress = getenv('HTTP_X_FORWARDED');
	} else if (getenv('HTTP_FORWARDED_FOR')) {
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	} else if (getenv('HTTP_FORWARDED')) {
		$ipaddress = getenv('HTTP_FORWARDED');
	} else if (getenv('REMOTE_ADDR')) {
		$ipaddress = getenv('REMOTE_ADDR');
	} else {
		$ipaddress = 'UNKNOWN';
	}

	return $ipaddress;
}
function weitoeth($amount)
{
	if ($amount > 0) {
		return $amount / 1000000000000000000;
	} else {
		return 0;
	}
}
function weitousdt($amount, $tokenDecimal = null)
{
	if ($amount == 0) {
		return 0;
	}
	if ($amount > 0) {
		if ($tokenDecimal) {
			if ($tokenDecimal > 0) {
				$tokenDecimal = 1 + $tokenDecimal;
				$number = 1;
				$number = str_pad($number, $tokenDecimal, '0', STR_PAD_RIGHT);
			} else {
				$number = 1;
			}
			return $amount / $number;
		} else {
			return $amount / 1;
		}
	} else {
		return 0;
	}
}
function convert_digits($amount, $tokenDecimal = null)
{
	if (!empty($amount)) {
		if ($tokenDecimal > 0) {
			$tokenDecimal = 1 + $tokenDecimal;
			$number = 1;
			$number = str_pad($number, $tokenDecimal, '0', STR_PAD_RIGHT);
		} else {
			$number = 1;
		}
		return $amount * $number;
	}
}

