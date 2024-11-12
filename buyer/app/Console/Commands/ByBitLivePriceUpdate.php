<?php

namespace App\Console\Commands;

use App\Models\Commission;
use Illuminate\Console\Command;
use App\TradePrice;
use App\TradePairLivePrice;
use App\Models\Tradepair;
use App\Traits\TradeData;


class ByBitLivePriceUpdate extends Command
{
    use TradeData;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:bybitliveprice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Live price for all trade pair using bybit';

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

        // $Ticker = json_decode(crul("https://api.bybit.com/spot/v3/public/quote/ticker/24hr"));
        
        // $Ticker = $Ticker->result->list;
        // if (count($Ticker) > 0) {
        //     foreach ($Ticker as $dataget) {
        //         $pairsymbol = $dataget->s;
        //         $trade =  Tradepair::where(['symbol' => $pairsymbol])->get();
        //         if (count($trade) > 0) {
        //             foreach ($trade as $trades) {

        //                 $change     = ncSub($dataget->lp,$dataget->o,8);
        //                 $charge_per = ncDiv($change,$dataget->o,8);
        //                 $hrchange   = ncMul($charge_per,100,8);

        //                 $Wtrade =  Tradepair::where('id', $trades->id)->first();
        //                 $Wtrade->open = $dataget->o;
        //                 $Wtrade->high =  $dataget->h;
        //                 $Wtrade->low =  $dataget->l;
        //                 $Wtrade->close = $dataget->lp;
        //                 $Wtrade->live_price = $dataget->lp;
        //                 $Wtrade->hrvolume  = $dataget->v;
        //                 $Wtrade->hrchange  = $hrchange;
        //                 $Wtrade->updated_at  = date('Y-m-d H:i:s', time());
        //                 $Wtrade->save();
        //             }
        //         }
        //     }
        // }

        // $this->info('Trade Price update successfully');
    }
}
