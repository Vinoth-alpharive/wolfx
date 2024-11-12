<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SwapCoinPair;


class LivePriceUpdateSwap extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:Swapliveprice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Live price for all Swap trade pair';

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

        // $trade = SwapCoinPair::get();

        // foreach ($trade as $trades) {

        //     $conone = $trades->coinone;
        //     $contwo = $trades->cointwo;
        //     $jsonResponse = crul('https://min-api.cryptocompare.com/data/pricemulti?fsyms=' . $conone . '&tsyms=' . $contwo . '%2C');
        //     $data = json_decode($jsonResponse, true);
        //     if (!isset($data['Type'])) {
        //         $Value = $data[$conone][$contwo];
        //         if (isset($Value)) {
        //             $pair = SwapCoinPair::where('id', $trades->id)->first();
        //             $pair->liveprice = $Value;
        //             $pair->active = 1;
        //             $pair->save();
        //         }
        //     }
        // }

        $Ticker = json_decode(crul("https://api.wazirx.com/sapi/v1/tickers/24hr"));
        if (count($Ticker) > 0) {
            foreach ($Ticker as $dataget) {
                $pairsymbol = $dataget->symbol;
                $swapPairs = SwapCoinPair::where('symbol', $pairsymbol)->get();
                if (count($swapPairs) > 0) {
                    foreach ($swapPairs as $swap) {
                        // $Wtrade =  SwapCoinPair::where('id', $swap->id)->first();
                        $swap->liveprice = $dataget->lastPrice;
                        // $swap->updated_at  = date('Y-m-d H:i:s', time());
                        $swap->save();
                    }
                }
            }
        }

        //TO UPDATE SWAP LIVE PRICE
        $exchangeTicker = json_decode(crul("https://api.poloniex.com/markets/price"));
        $swapPairs = SwapCoinPair::get();

        foreach ($exchangeTicker as $ticker) {
            $pair = explode('_', $ticker->symbol);
            $symbol = $pair[0] . $pair[1];

            $swap = $swapPairs->where('symbol', $symbol)->first();
            if ($swap) {
                $swap->liveprice = $ticker->price;
                $swap->save();
            }
        }

        //TO UPDATE SWAP LIVE PRICE
        $exchangeTicker = json_decode(crul("https://api.binance.com/api/v3/ticker/price"));
        $tickers = $exchangeTicker;
        $swapPairs = SwapCoinPair::get();

        foreach ($tickers as $ticker) {
            // echo json_encode($ticker);
            $symbol = $ticker->symbol;
            $swap = $swapPairs->where('symbol', $symbol)->first();

            if ($swap) {
                $swap->liveprice = $ticker->price;
                $swap->save();
            }
        }

        // $url = "https://api.wazirx.com/sapi/v1/tickers/24hr";
        // $wazirx = json_decode(crul($url), true);
        // if ($wazirx) {
        //     foreach ($wazirx as $data) {
        //         if (isset($data['symbol'])) {
        //             $live = SwapCoinPair::where('symbol', $data['symbol'])->first();
        //             if (is_object($live)) {
        //                 $live->liveprice = $data['lastPrice'];
        //                 $live->updated_at = date('Y-m-d H:i:s', time());
        //                 $live->save();
        //             }
        //         }
        //     }
        // }

        $this->info('Swap Live Price updated');
    }
}
