<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CryptoTransactions;
use App\Models\UserEthAddress;
use App\Traits\TokenERCClass;
use Illuminate\Support\Facades\DB;

class TokenColdWallet extends Command
{
     use TokenERCClass;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coldwallet:token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move Token balance to admin cold wallet';

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
        $coins = Commission::where('type','token')->get();
        if(count($coins) > 0){
            foreach ($coins as $token) {
                $coin = $token->source;
                $trans = CryptoTransactions::select('to_addr',DB::raw('SUM(amount) as amt'), DB::raw("GROUP_CONCAT(id) AS ids"),DB::raw("GROUP_CONCAT(uid) AS uids"))->where(['nirvaki_nilai' => 0,'currency' => $coin])->groupBy('to_addr')->get();
                if(count($trans) > 0){
                    foreach ($trans as $tran) {
                        $ids = explode(',',$tran->ids);
                        $uids = explode(',',$tran->uids);

                        $uid    = $uids[0];
                        $amount = $tran->amt;
                        $fee    = 0;
                        $total  = ncSub($amount,$fee,8);
        				if($total > 0){
                            $toaddress = '';
                            $send   = $this->createTransactionERCToken($uid,$coin,$toaddress,$total);
        					if($send){
                                foreach ($ids as $id) {
        						  CryptoTransactions::where(['id'=> $id])->update(['nirvaki_nilai' => 100, 'updated_at' => date('Y-m-d H:i:s',time())]);
                                }
        					}
        				}
                    }
                }
            }
        }
        $this->info('TOKEN cold wallet updated to All Users');
    }
}
