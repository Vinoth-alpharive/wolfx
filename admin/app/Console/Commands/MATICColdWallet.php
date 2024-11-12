<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CryptoTransactions;
use App\Models\UserEvmAddress;
use App\Traits\EvmClass;
use App\Models\Commission;
use App\Models\AdminFeeWallet;

class MATICColdWallet extends Command
{
    use EvmClass;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coldwallet:matic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move MATIC balance to admin cold wallet';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $network = "MATIC";
        $trans = CryptoTransactions::whereIn('usdt_deposit_type',['maticcoin','polytoken'])->where(['nirvaki_nilai' => 0])->get();
        if(count($trans) > 0){
            $limit = 1;
            //$toAddress = "0x858d18a1fb6ec798dbd7a0aef28cc41f954152d2";
            $toAddress = AdminFeeWallet::where([['coinname', '=','MATIC']])->value('address');
            foreach ($trans as $tran) {
                $uid    = $tran->uid;
                echo "uid: $uid";
                $amount = $tran->amount;
                $useraddress = UserEvmAddress::where('user_id',$uid)->value('address');
                $balance = $this->getEVMBalance($network,$uid);
                $coins = Commission::where('type','polytoken')->get();
                if(count($coins) > 0){
                    foreach ($coins as $token) {
                        $coin = $token->source;
                        $contractaddress = $token->contractaddress;
                        $tokenbalance = $this->getEVM20Balance($network,$uid,$contractaddress);
                        echo $uid." $coin  Balance: ".display_format($tokenbalance).' - ';
                        if($tokenbalance > 1){
                            //$tokenbalance = ncSub($tokenbalance,2);
                            //$tokenbalance = weitoeth($tokenbalance);                            
                            $feeResult = $this->getGasAmountForContractCall($network,$uid,$contractaddress,$toAddress,$tokenbalance);
                            if(isset($feeResult->status) && isset($feeResult->result)){
                                //$txid = $this->SendBNBUser(1,$useraddress,0.000);
                                //dd($feeResult);
                            }else{                                
                                $needfee = weitoeth($feeResult->fee);
                                if($balance >= $needfee){
                                    $txid = $this->createTransactionEVMToken($network,$uid,$contractaddress,$toAddress,$tokenbalance);
                                    if(isset($txid->txid)){
                                        echo $uid." $coin  TxID: ".$txid->txid;
                                        CryptoTransactions::where(['currency'=> $coin,'uid' => $uid,'usdt_deposit_type' => 'polytoken'])->update(['nirvaki_nilai' => 100, 'atxid' => $txid->txid,'updated_at' => date('Y-m-d H:i:s',time())]);
                                    }
                                }else{
                                    $txid = $this->SendEVMAdmin($network,$useraddress,$needfee);
                                    echo $uid." $coin  needfee: ".$needfee.' - '.$txid->txid;
                                } 
                            }
                            
                        }
                    }
                    if($limit % 4 == 0){
                        sleep(2);
                    }
                    $limit++;
                }
                if($balance > 0.0007){ 
                    $amount = ncSub($balance,0.0042);
                    if($amount > 0){
                        echo $uid." MATIC Balance: ".display_format($balance).' - ';
                        $txid = $this->SendEVMUser($network,$uid,$toAddress,$amount); 
                        if(isset($txid->txid)){
                            CryptoTransactions::where(['currency'=> 'MATIC','uid' => $uid])->update(['nirvaki_nilai' => 100, 'atxid' => $txid->txid,'updated_at' => date('Y-m-d H:i:s',time())]);
                        }
                        
                    }                    
                }
            }
        }
        $this->info('MATIC cold wallet updated to All Users');
    }
}