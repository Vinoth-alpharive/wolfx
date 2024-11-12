<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Models\PurchaseHistory;
use App\Models\SellRequest;
use Carbon;

class UpdateInCompleteOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:orders';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Incomplete Order';
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
        try {
            //buyer match but not transaction 
            $ct = Carbon::now();
            $pOrders = PurchaseHistory::where('status', 1)->whereNull('buyer_remark')->where('expired_at', '<', $ct)->get();
            foreach ($pOrders as $po) {

                $pOrders->status = 5;
                $pOrders->remark = 'CANCELLED';
                $pOrders->save();
                //sell order
                $sO = SellRequest::where(['id' => $pOrders->requestId])->first();
                if ($sO) {

                    $sO->status = 0;
                    $sO->remark = "PENDING";
                    $sO->is_hold = 0;
                }
            }
            //buyer paid but seller not debit
            $ct = Carbon::now();
            $pOrders = PurchaseHistory::where('status', 1)->whereNotNull('buyer_remark')->where('expired_at', '<', $ct)->get();
            foreach ($pOrders as $po) {
                $po->seller_remark = "Deny";
                $po->save();
            }
        } catch (\Exception $e) {
            dd($e);
        }
        $this->info('Update Incomplete Orders');
    }
}
