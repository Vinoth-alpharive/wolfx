<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tanippatta_Panappais;
use App\Models\FeeTokenWallet;
use App\UserTokenAddress;
use App\TokenTransaction;
use App\Traits\TrcClass;
use App\Models\AdminFeeWallet;
use App\FeeWalletTransaction;
use App\Traits\BtcClass;
use App\Traits\LtcClass;
use App\Traits\EthClass;
use App\Traits\XrpClass;
use Illuminate\Support\Facades\Crypt;
use App\Models\Commission;

class AdminAddressController extends Controller
{
    use TrcClass,BtcClass,EthClass,XrpClass,LtcClass;
    public function __construct()
    {
        $this->middleware('admin');
    }
/*
    public function index()
    {
        $adminwallet = Tanippatta_Panappais::index();
        return view('adminwallet.adminwallet',[
            'adminwallet' => $adminwallet
        ]);
    }*/

    public function index1()
    {
        $adminwallet = FeeTokenWallet::index();
        return view('adminwallet.adminwallet',[
            'adminwallet' => $adminwallet
        ]);
    }
    public function index()
    {
        $feewallet = FeeTokenWallet::where('id',1)->first();
        $adminwallet = UserTokenAddress::where('mugavari',$feewallet->mugavari)->first();
        $depositList = TokenTransaction::where('uid',$adminwallet->user_id)->orderBy('id','Desc')->paginate(20);
        return view('admin.feewallet',[
            'data' => $adminwallet,'depositList' => $depositList,'coin' => 'NAS']);
    }
    public function adminsendtoken(Request $request)
    {
        $this->validate($request, [               
        'amount' => 'required|numeric',            
        'toaddress' => 'required',                   
        ]);
        $amount = $request->amount;
        $to_address = $request->toaddress;
        $send = $this->AdminTrc10SendAmount($to_address,$amount);
        if($send){
            return back()->with('success','Token Successfully sended.Reference tranasction ID is '.$send);
        }else{
            return back()->with('erreo','Token Not sended please try again later');
        }

        
    }

    public function edit($id)
    {
        $adminwallet = Tanippatta_Panappais::edit(Crypt::decrypt($id));

        return view('adminwallet.edit')->with('adminwallet',$adminwallet);
    }

    public function adminwalletupdate(Request $request)
    {


        if($request->coin_name=='BTC'){
            $this->validate($request, [
                'coin_name' => 'required',
                'address' => 'regex:/^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$/'
            ]);
        }elseif($request->coin_name=='ETH'){
            $this->validate($request, [
                'coin_name' => 'required',
                'address' => 'regex:/^0x[a-fA-F0-9]{40}$/'
            ]);
        }elseif($request->coin_name=='LTC'){
            $this->validate($request, [
                'coin_name' => 'required',
                'address' => 'regex:/^[LM3][a-km-zA-HJ-NP-Z1-9]{26,33}$/'
            ]);
        }

        $commission = Tanippatta_Panappais::adminwalletupdate($request);

        return back()->with('status','Address Updated Successfully');
    }

    public function feewalletBTC(){
        $ethtable = $this->btc_admin_address_create();    
        $useraddress = $ethtable->address;
        $credential = explode(',',$ethtable->narcanru);
        $pvk = Crypt::decryptString($credential[0]);
        $this->transactionBTC($useraddress);
        $depositList = FeeWalletTransaction::where('currency','BTC')->orderBy('id','Desc')->paginate(10);

        $coinlists = Commission::whereNotIn('type',['fiat'])->where('status',1)->get();
        return view('admin.feewallet',[
            'data' => $ethtable,'pvk' => $pvk,'depositList' => $depositList,'coinlists' => $coinlists,'coin' => 'BTC']);
    }

    public function feewalletLTC(){
        $ethtable = $this->ltc_admin_address_create();    
        $useraddress = $ethtable->address;
        $credential = explode(',',$ethtable->narcanru);
        $pvk = Crypt::decryptString($credential[0]);
        $this->transactionLTC($useraddress);
        $depositList = FeeWalletTransaction::where('currency','LTC')->orderBy('id','Desc')->paginate(10);

        $coinlists = Commission::whereNotIn('type',['fiat'])->where('status',1)->get();
        return view('admin.feewallet',[
            'data' => $ethtable,'pvk' => $pvk,'depositList' => $depositList,'coinlists' => $coinlists,'coin' => 'LTC']);
    }
    public function feewalletXRP(){
        $ethtable = $this->xrp_admin_address_create();    
        $useraddress = $ethtable->address;
        $credential = explode(',',$ethtable->narcanru);
        $pvk = Crypt::decryptString($credential[0]);
        //$this->transactionBTC($useraddress);
        $depositList = FeeWalletTransaction::where('currency','XRP')->orderBy('id','Desc')->paginate(10);

        $coinlists = Commission::whereNotIn('type',['fiat'])->where('status',1)->get();
        return view('admin.feewallet',[
            'data' => $ethtable,'pvk' => $pvk,'depositList' => $depositList,'coinlists' => $coinlists,'coin' => 'XRP']);
    }
    public function feewalletTRX(){
        $ethtable = $this->trx_admin_address_create();    
        $useraddress = $ethtable->address;
        $credential = explode(',',$ethtable->narcanru);
        $pvk = Crypt::decrypt($credential[1]);
        $this->adminTransactionTrx();
        $depositList = FeeWalletTransaction::where('currency','TRX')->orderBy('id','Desc')->paginate(10);

        $coinlists = Commission::whereNotIn('type',['fiat'])->where('status',1)->get();
        return view('admin.feewallet',[
            'data' => $ethtable,'pvk' => $pvk,'depositList' => $depositList,'coinlists' => $coinlists,'coin' => 'TRX']);
    }
    public function transactionBTC($useraddress){
        if($useraddress){
            $url = 'https://insight.bitpay.com/api/txs/?address='.$useraddress;
            $tran = crul($url);
            $tran = json_decode($tran);
            if($tran){      
            if(count($tran->txs) > 0){
              foreach($tran->txs as $addr){
                $order_no   = TransactionString().$uid;
                $txid       = $addr->txid;
                $sender     = $addr->vin[0]->addr;
                $confirm    = $addr->confirmations;
                $fees       = $addr->fees;
                $time       = $addr->time;
                foreach ($addr->vout as $vout) {
                    if(isset($vout->scriptPubKey->addresses)){
                        if(in_array($useraddress , $vout->scriptPubKey->addresses)){
                            $receiver = $useraddress;
                            $amount = $vout->value;
                            break;
                        }else{
                            $receiver = $addr->vout[0]->addr;
                        }
                    }else{
                        $receiver = "";
                    }                 
                }
                foreach ($addr->vin as $vin) {
                    if(isset($vin->scriptPubKey->addresses)){
                        if(in_array($useraddress , $vin->scriptPubKey->addresses)){
                            $sender = $useraddress;
                            $amount = $vin->value;
                            break;
                        }else{
                            $sender = $addr->vin[0]->addr;
                        }
                    }else{
                        $sender = "";
                    }                 
                }
                if($sender != $receiver){
                    if($receiver == $useraddress)
                    {
                      $type = 'Received';
                    }else{
                        $type = 'Send';
                    }
                }
                $tran = FeeWalletTransaction::where(['currency' => 'BTC','txid' => $txid])->first();
                if(!$tran){
                    $tran = new FeeWalletTransaction();
                    $tran->currency = "BTC";
                    $tran->txtype = $type;
                    $tran->txid = $txid;
                    $tran->from_addr = $sender;
                    $tran->to_addr = $receiver;
                    $tran->amount = $amount;            
                    $tran->status = 2;
                    $tran->created_at = $time;
                }
                $tran->confirmation = $confirm;
                $tran->updated_at = date('Y-m-d H:i:s',time());
                $tran->save();
              }
            }
          }            
        }
    }
    public function transactionLTC($useraddress){
        if($useraddress){
            $url = 'https://insight.litecore.io/api/txs/?address='.$useraddress;
            $tran = crul($url);
            $tran = json_decode($tran);
            if($tran){      
            if(count($tran->txs) > 0){
              foreach($tran->txs as $addr){
                $order_no   = TransactionString().$uid;
                $txid       = $addr->txid;
                $sender     = $addr->vin[0]->addr;
                $confirm    = $addr->confirmations;
                $fees       = $addr->fees;
                $time       = $addr->time;
                foreach ($addr->vout as $vout) {
                    if(isset($vout->scriptPubKey->addresses)){
                        if(in_array($useraddress , $vout->scriptPubKey->addresses)){
                            $receiver = $useraddress;
                            $amount = $vout->value;
                            break;
                        }else{
                            $receiver = $addr->vout[0]->addr;
                        }
                    }else{
                        $receiver = "";
                    }                 
                }
                foreach ($addr->vin as $vin) {
                    if(isset($vin->scriptPubKey->addresses)){
                        if(in_array($useraddress , $vin->scriptPubKey->addresses)){
                            $sender = $useraddress;
                            $amount = $vin->value;
                            break;
                        }else{
                            $sender = $addr->vin[0]->addr;
                        }
                    }else{
                        $sender = "";
                    }                 
                }
                if($sender != $receiver){
                    if($receiver == $useraddress)
                    {
                      $type = 'Received';
                    }else{
                        $type = 'Send';
                    }
                }
                $tran = FeeWalletTransaction::where(['currency' => 'BTC','txid' => $txid])->first();
                if(!$tran){
                    $tran = new FeeWalletTransaction();
                    $tran->currency = "BTC";
                    $tran->txtype = $type;
                    $tran->txid = $txid;
                    $tran->from_addr = $sender;
                    $tran->to_addr = $receiver;
                    $tran->amount = $amount;            
                    $tran->status = 2;
                    $tran->created_at = $time;
                }
                $tran->confirmation = $confirm;
                $tran->updated_at = date('Y-m-d H:i:s',time());
                $tran->save();
              }
            }
          }            
        }
    }
    public function transactionTRX($useraddress){
        if($useraddress){

            $url = 'https://insight.bitpay.com/api/txs/?address='.$useraddress;
            $tran = crul($url);
            $tran = json_decode($tran);
            if($tran){      
            if(count($tran->txs) > 0){
              foreach($tran->txs as $addr){
                $order_no   = TransactionString().$uid;
                $txid       = $addr->txid;
                $sender     = $addr->vin[0]->addr;
                $confirm    = $addr->confirmations;
                $fees       = $addr->fees;
                $time       = $addr->time;
                foreach ($addr->vout as $vout) {
                    if(isset($vout->scriptPubKey->addresses)){
                        if(in_array($useraddress , $vout->scriptPubKey->addresses)){
                            $receiver = $useraddress;
                            $amount = $vout->value;
                            break;
                        }else{
                            $receiver = $addr->vout[0]->addr;
                        }
                    }else{
                        $receiver = "";
                    }                 
                }
                foreach ($addr->vin as $vin) {
                    if(isset($vin->scriptPubKey->addresses)){
                        if(in_array($useraddress , $vin->scriptPubKey->addresses)){
                            $sender = $useraddress;
                            $amount = $vin->value;
                            break;
                        }else{
                            $sender = $addr->vin[0]->addr;
                        }
                    }else{
                        $sender = "";
                    }                 
                }
                if($sender != $receiver){
                    if($receiver == $useraddress)
                    {
                      $type = 'Received';
                    }else{
                        $type = 'Send';
                    }
                }
                $tran = FeeWalletTransaction::where(['currency' => 'BTC','txid' => $txid])->first();
                if(!$tran){
                    $tran = new FeeWalletTransaction();
                    $tran->currency = "BTC";
                    $tran->txtype = $type;
                    $tran->txid = $txid;
                    $tran->from_addr = $sender;
                    $tran->to_addr = $receiver;
                    $tran->amount = $amount;            
                    $tran->status = 2;
                    $tran->created_at = $time;
                }
                $tran->confirmation = $confirm;
                $tran->updated_at = date('Y-m-d H:i:s',time());
                $tran->save();
              }
            }
          }            
        }
    }
    public function sendWallet(Request $request){
        $this->validate($request, [   
                    'coinname' => 'required',
                    'toaddress' => 'required',
                    'amount' => 'required',
                ]);
        $coin = $request->coinname;
        $toaddress = $request->toaddress;
        $amount = $request->amount;
        $send   = $this->createAdminBtcTransaction($toaddress,$amount,0.0005);                    
        if($send){
            if(isset($send->txid)){
                $txnid = $send->txid;
            }elseif(isset($send->tx->hash)){
                $txnid = $send->tx->hash;
            }else{
                $txnid = "No";
            }
        }
        return Redirect::back()->with( 'success', "Your transaction ID is $txnid");
    }
    public function feeWallet($coin='ETH'){
        $coinlists = Commission::where('source',$coin)->first();
        if($coinlists->type == 'token'){
            return $this->feeWalletToken($coin,$coinlists->contractaddress,$coinlists->decimal);
        }else{
            $coinfn = "feeWallet".$coin;
            return $this->$coinfn();
        }        
    }
    public function feeWalletETH(){        
        $ethtable = AdminFeeWallet::where('coinname','ETH')->first(); 
        if(!$ethtable){
            $address_gen = $this->ethcreate();
            $pvtk = Crypt::encryptString($address_gen->private);
            $pubk = Crypt::encryptString($address_gen->public);
            $address = "0x".$address_gen->address;

            $ethtable = new AdminFeeWallet;
            $ethtable->coinname = "ETH";
            $ethtable->address    = $address;
            $ethtable->narcanru   = $pvtk.','.$pubk;
            $ethtable->fee = 0.00042;
            $ethtable->balance = 0.00000000;
            $ethtable->save();
        }        
        $useraddress = $ethtable->address;
        $credential = explode(',',$ethtable->narcanru);
        $pvk = Crypt::decryptString($credential[0]);
        $depositList = FeeWalletTransaction::where('currency','ETH')->orderBy('id','Desc')->paginate(10);
        $ethurl = "https://api.etherscan.io/api?module=account&apikey=WZTRZ613U3X53WQ5NS2GY782FTUAF93XK7&action=balance&address=".$useraddress;
            $ethresult = $this->cUrlss($ethurl);
            $ethbalance = $this->weitoeth($ethresult['result']);
            $ethtable->balance = $ethbalance;
            $ethtable->save();
        $this->transactionETH($useraddress);
        $coinlists = Commission::whereNotIn('type',['fiat'])->where('status',1)->get();
        return view('admin.feewallet',[
            'data' => $ethtable,'pvk' => $pvk,'depositList' => $depositList,'coinlists' => $coinlists,'coin' => 'ETH']);
    }

    public function feeWalletToken($coin,$contractaddress,$decimal){        
        $ethtable = AdminFeeWallet::where('coinname',$coin)->first();
        if(!$ethtable){
            $table = AdminFeeWallet::where('coinname','ETH')->first();
            $ethtable = new AdminFeeWallet;
            $ethtable->coinname = $coin;
            $ethtable->address = $table->address;
            $ethtable->narcanru = $table->narcanru;
            $ethtable->fee = 0.00042;
            $ethtable->balance = 0.00000000;
            $ethtable->save();
        }        
        $useraddress = $ethtable->address;
        $credential = explode(',',$ethtable->narcanru);
        $pvk = Crypt::decryptString($credential[0]);
        $depositList = FeeWalletTransaction::where('currency',$coin)->orderBy('id','Desc')->paginate(10);
        $ethurl = "https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress=".$contractaddress."&address=".$useraddress."&tag=latest&apikey=WZTRZ613U3X53WQ5NS2GY782FTUAF93XK7";
            $ethresult = $this->cUrlss($ethurl);
            $ethbalance = $this->weitousdt($ethresult['result'],$decimal);
            $ethtable->balance = $ethbalance;
            $ethtable->save();
        $this->transactionToken($useraddress);
        $coinlists = Commission::whereNotIn('type',['fiat'])->where('status',1)->get();
        return view('admin.feewallet',[
            'data' => $ethtable,'pvk' => $pvk,'depositList' => $depositList,'coinlists' => $coinlists,'coin' => $coin]);
    }
    public function cUrlss($url, $postfilds=null){
         $this->url = $url;
         $this->ch = curl_init();
         curl_setopt($this->ch, CURLOPT_URL, $this->url);
         curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
         if(!is_null($postfilds)){
         curl_setopt($this->ch, CURLOPT_POSTFIELDS, $postfilds);
         }
         if(strpos($this->url, '?') !== false){
         curl_setopt($this->ch, CURLOPT_POST, 1);
         }
         $headers = array('Content-Length: 0');
         $headers[] = "Content-Type: application/x-www-form-urlencoded";
         curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
         if (curl_errno($this->ch)) {
         $this->result = 'Error:' . curl_error($this->ch);
         } else {
         $this->result = curl_exec($this->ch);
         } 
         curl_close($this->ch);
         return json_decode($this->result, true);
    }
    public function transactionETH($useraddress){
        if($useraddress){        
            $url = "http://api.etherscan.io/api?module=account&action=txlist&address=".$useraddress."&startblock=0&endblock=99999999&sort=asc&apikey=DBIVHXYCZNDVHTCEINY31KKM3REVEURXB9";
            $balance = $this->cUrlss($url);
            if(isset($balance['result'])){
                $count = count($balance['result']);
            }else{
                $count = 0;
            }
            if($count > 0)
            {
               $result_data = $balance['result'];
                for($i = 0; $i < $count; $i++)
                {
                    $data     = $result_data[$i];
                    $txid     = $data['hash'];
                    $confirm  = $data['confirmations'];
                    $from     = $data['from'];
                    $to       = $data['to'];               
                    $time     = date('Y-m-d H:i:s',$data['timeStamp']);               
                    $total    = self::weitoeth($data['value']);
                    $order_no = TransactionString();
                    $amount   = display_format($total,8);
                    if($to == $useraddress){
                        $type = 'Received';
                    }else{
                        $type = 'Send';
                    }
                    $tran = FeeWalletTransaction::where(['currency' => 'ETH','txid' => $txid])->first();
                    if(!$tran){
                        $tran = new FeeWalletTransaction();
                        $tran->currency = "ETH";
                        $tran->txtype = $type;
                        $tran->txid = $txid;
                        $tran->from_addr = $from;
                        $tran->to_addr = $to;
                        $tran->amount = $amount;            
                        $tran->status = 2;
                        $tran->created_at = $time;
                    }
                    $tran->confirmation = $confirm;
                    $tran->updated_at = date('Y-m-d H:i:s',time());
                    $tran->save();
                }
            }
        }
    }
    public function transactionToken($useraddress){
        if($useraddress){
            $apikey = "514A3XGJZD82WJU73J6MMWH4QUG5I54EM7";
            $url = "https://api.etherscan.io/api?module=account&action=tokentx&address=".$useraddress."&startblock=0&endblock=999999999&sort=asc&apikey=".$apikey;
            $result_data = $this->cUrlss($url);
            if(isset($result_data['result'])){
                if(count($result_data['result']) > 0){
                    foreach ($result_data['result'] as $data) { 
                        $tokenSymbol    = $data['tokenSymbol'];
                        $contractAddress = $data['contractAddress'];
                        $txid           = $data['hash'];
                        $time           = date('Y-m-d H:i:s',$data['timeStamp']);
                        $from           = $data['from'];
                        $to             = $data['to'];
                        $confirmations  = $data['confirmations'];
                        $total          = self::weitousdt($data['value'],$data['tokenDecimal']);
                        //print_r($useraddress.' -'.$to.' total:'.$total.' decimal:'.$data['tokenDecimal']);
                        $total = sprintf('%.8f',$total);
                        if($to == $useraddress){
                            $type = 'Received';
                        }else{
                            $type = 'Send';
                        }
                        $tran = FeeWalletTransaction::where(['currency' => $tokenSymbol,'txid' => $txid])->first();
                        if(!$tran){
                            $tran = new FeeWalletTransaction();
                            $tran->currency = $tokenSymbol;
                            $tran->txtype = $type;
                            $tran->txid = $txid;
                            $tran->from_addr = $from;
                            $tran->to_addr = $to;
                            $tran->amount = $total;            
                            $tran->status = 2;
                            $tran->created_at = $time;
                        }
                        $tran->confirmation = $confirmations;
                        $tran->updated_at = date('Y-m-d H:i:s',time());
                        $tran->save();
                    }
                }
            }
        }
    }
    public function weitoeth($amount){
        return $amount / 1000000000000000000;
    }
    public function weitousdt($amount,$tokenDecimal=null){
        if($amount == 0){
            return 0;
        }
        if($tokenDecimal){
            if($tokenDecimal > 0){
               $tokenDecimal = 1 + $tokenDecimal;
                $number = 1;
                $number = str_pad($number, $tokenDecimal, '0', STR_PAD_RIGHT);  
            }else{
                $number = 1;
            }         
            return $amount / $number;
        }else{
            return $amount / 1;
        }
    }
}
