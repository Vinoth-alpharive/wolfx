<?php

namespace App\Console\Commands;

use App\Models\Commission;
use Illuminate\Console\Command;
use App\TradePrice;
use App\TradePairLivePrice;
use App\Models\Tradepair;
use App\Models\SwapCoinPair;
use App\Traits\TradeData;

class LivePriceUpdate extends Command
{
    use TradeData;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:liveprice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Live price for all trade pair';

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

        $Ticker = json_decode(crul("https://api.wazirx.com/sapi/v1/tickers/24hr"));
        if (count($Ticker) > 0) {
            foreach ($Ticker as $dataget) {
                $pairsymbol = $dataget->symbol;
                $trade =  Tradepair::where(['symbol' => $pairsymbol])->get();
                if (count($trade) > 0) {
                    foreach ($trade as $trades) {
                        $Wtrade =  Tradepair::where('id', $trades->id)->first();
                        $Wtrade->open = $dataget->openPrice;
                        $Wtrade->high =  $dataget->highPrice;
                        $Wtrade->low =  $dataget->lowPrice;
                        $Wtrade->close = $dataget->lastPrice;
                        $Wtrade->live_price = $dataget->lastPrice;
                        $Wtrade->hrvolume  = $dataget->volume;
                        $Wtrade->updated_at  = date('Y-m-d H:i:s', time());
                        $Wtrade->save();
                    }
                }
            }
        }

        $exchangeTicker = json_decode(crul("https://api.coincap.io/v2/assets"));
        if (count($exchangeTicker->data) > 0) {
            foreach ($exchangeTicker->data as $dataget) {
                $pairsymbol = $dataget->symbol;
                $data =  Commission::where(['source' => $pairsymbol])->get();
                if (count($data) > 0) {
                    foreach ($data as $trades) {
                        $trades =  Commission::where('id', $trades->id)->first();
                        $trades->usd_value  = $dataget->priceUsd;
                        $trades->updated_at  = date('Y-m-d H:i:s', time());
                        $trades->save();
                    }
                }
            }
        }
        $this->info('Trade Price update successfully');
    }
}
