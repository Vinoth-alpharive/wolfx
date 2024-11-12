<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tradepair;
use App\Models\Commission;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\CoincommissionRequest;
use App\Http\Requests\TradepairRequest;
use Storage;
use App\Models\User;
use App\Models\BuyTrades;
use App\Models\Trades;
use App\Models\SellTrades;
use App\Models\Completedtrade;
use App\Models\UserWallet;
use App\Models\Liveprice;
use Illuminate\Support\Facades\Validator;

class TradepairController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $commission =  Commission::on('mysql2')->whereNotIn('type', ['fiat','coin'])->paginate(15);
        return view('tradepair.commission',['commissions' => $commission]);
    }
    
     public function addcoin(Request $request)
    {
        
        return view('tradepair.add');
    }
    public function addcoininsert(CoincommissionRequest $request)
    {
        try {
            if(isset($request->image)){
                $pho = $request->image;
                $filenamewithextension = $pho->getClientOriginalName();
                $photnam = strtolower($request->symbol);
                $filename = pathinfo($photnam, PATHINFO_FILENAME);
                $extension = $pho->getClientOriginalExtension();
                $photo = $filename . '.' . $extension;
                Storage::disk('ftpcoin')->put($photo, fopen($request->file('image'), 'r+'));
                //$path = '../user/images' . DIRECTORY_SEPARATOR .'color'. DIRECTORY_SEPARATOR;
                //$pho->move($path, $photo);
            }else{
                $photo = 'eth.svg';
            } 
        }catch (Exception $e) { 
            $photo = strtolower($request->symbol).'.svg';
        }

        $commission = new Commission();
        $commission->source        = $request->symbol; 
        $commission->withdraw  = $request->withdraw;
        $commission->type = $request->type;
        $commission->coinname = $request->coinname;
        $commission->point_value = $request->digit;
        $commission->decimal_value = $request->decimal_value;
        $commission->netfee = $request->netfee;
        $commission->contractaddress = $request->contractaddress;
        $commission->abiarray = $request->abiarray;
        $commission->min_deposit = $request->min_deposit;
        $commission->min_withdraw = $request->min_withdraw;
        $commission->com_type = $request->com_type;
        $commission->orderlist = $request->orderlist;
        $commission->shown = $request->status;
        $commission->is_swap =$request->is_swap;
        // $commission->market_cap = $request->market_cap;
        // $commission->diluted_market_cap = $request->diluted_market_cap;
        // $commission->market_dominance = $request->market_dominance;
        // $commission->circulation_supply = $request->circulation_supply;
        // $commission->issue_date = $request->issue_date;
        // $commission->issue_price = $request->issue_price;
        // $commission->all_time_high = $request->all_time_high;
        // $commission->all_time_low = $request->all_time_low;
        // $commission->introduction = $request->introduction;
        // $commission->ranking = $request->ranking;
        // $commission->maximum_supply = $request->maximum_supply;
        // $commission->trade_link = $request->trade_link;
        $commission->is_deposit = $request->is_deposit;
        $commission->is_withdraw = $request->is_withdraw;
        $commission->image = $photo;
        $commission->save();

        User::where(['email_verify' => 1])->update(['is_address' => 0, 'updated_at' => date('Y-m-d H:i:s',time())]);
        return back()->with('status','Coin Added Successfully');
    }

    public function edit($id)
    {
        $id  =Crypt::decrypt($id);
        $commission = Commission::on('mysql2')->where('id', $id)->first();
        return view('tradepair.edit')->with('commission',$commission);
    }

    public function Update(CoincommissionRequest $request)

    {
        $commission = Commission::on('mysql2')->where('id', $request->id)->first();
        if($commission->source != $request->symbol){
            $cointwos = Tradepair::on('mysql2')->where([['cointwo' ,'=', $commission->source]])->update(['cointwo' => $request->symbol]);
            $coinones = Tradepair::on('mysql2')->where([['coinone' ,'=', $commission->source]])->update(['coinone' => $request->symbol]);
            UserWallet::on('mysql2')->where([['currency' ,'=', $commission->source]])->update(['currency' => $request->symbol]);

        }        
        $commission->source        = $request->symbol; 
        $commission->withdraw  = $request->withdraw;
        $commission->type = $request->type;
        //$commission->walletpair =$request->walletpair;
        $commission->coinname = $request->coinname;
        $commission->decimal_value = $request->decimal_value;
        $commission->point_value = $request->digit;
        $commission->netfee = $request->netfee;
        $commission->contractaddress = $request->contractaddress;
        $commission->abiarray = $request->abiarray;
        $commission->min_deposit = $request->min_deposit;
        $commission->min_withdraw = $request->min_withdraw;
        $commission->shown = $request->status;
        $commission->is_swap =$request->is_swap;

        // $commission->market_cap = $request->market_cap;
        // $commission->diluted_market_cap = $request->diluted_market_cap;
        // $commission->market_dominance = $request->market_dominance;
        // $commission->circulation_supply = $request->circulation_supply;
        // $commission->maximum_supply = $request->maximum_supply;

        // $commission->official_website = $request->official_website;
        // $commission->white_paper = $request->white_paper;
        // $commission->block_explorer = $request->block_explorer;

        // $commission->issue_date = $request->issue_date;
        // $commission->issue_price = $request->issue_price;
        // $commission->all_time_high = $request->all_time_high;
        // $commission->all_time_low = $request->all_time_low;
        // $commission->introduction = $request->introduction;
        // $commission->ranking = $request->ranking;
        // $commission->notice = $request->notice;
        // $commission->trade_link = $request->trade_link;
        $commission->is_deposit = $request->is_deposit;
        $commission->is_withdraw = $request->is_withdraw;



        $commission->com_type = $request->com_type;
        $commission->orderlist = $request->orderlist;
         //Color icon image
        try {
            if(isset($request->image)){
                $pho = $request->image;
                $filenamewithextension = $pho->getClientOriginalName();
                $photnam = strtolower($request->symbol). str_replace('.', '', microtime(true));
                $filename = pathinfo($photnam, PATHINFO_FILENAME);
                $extension = $pho->getClientOriginalExtension();
                $photo = $filename . '.' . $extension;
                if($commission->image != ""){
                    Storage::disk('ftpcoin')->delete($commission->image);
                }
                Storage::disk('ftpcoin')->put($photo, fopen($request->file('image'), 'r+'));
                $commission->image = $photo;
                
            }else{
                $commission->image = $commission->image;
            }
        }catch (Exception $e) { 
            $commission->image = $commission->image;
        }

        $commission->save();

        return back()->with('status','Token Updated Successfully');
    }

    public function tradepairlist()
    {
        $tradepair =  Tradepair::on('mysql2')->paginate(10);

        return view('tradepair.tradepair',['tradepair' => $tradepair]);
    }


    public function tradesearch(Request $request)
    {

        $q = $request->searchitem;
        $details = Tradepair::trade_search(1, $q);

        return view('tradepair.tradepair', ['tradepair' => $details]);

    }


    public function pairedit($id)
    {
        
        $id  =Crypt::decrypt($id);
        $pairres = Tradepair::on('mysql2')->where('id', $id)->first();
        
        $Commission =  Commission::on('mysql2')->get();
        return view('tradepair.pairedit',['pairres' => $pairres,'commission' => $Commission]);
    }

    public function pairdelete($id){
        $id  =Crypt::decrypt($id);

        
    }
    

    public function addpair(Request $request)
    {
        $pairres =  Commission::on('mysql2')->get();
        $count =  Tradepair::count() + 1;
        return view('tradepair.addpair',['pairres' => $pairres,'count' => $count]);
    }

    public function addpairinsert(TradepairRequest $request)
    {
        
        $validator = Validator::make($request->all(), [
            'coinone' => 'required|max:50',
            'cointwo' => 'required|max:50',
            'min_price' => 'required',
            'max_price' => 'required',
            'average_price' => 'required',
            'status' =>'required',
            // 'min_buy_price' => 'required|numeric',
            // 'min_buy_amount' => 'required|numeric',
            // 'min_sell_price' => 'required|numeric',
            // 'min_sell_amount' => 'required|numeric',
            // 'buy_trade' => 'required|numeric',
            // 'sell_trade' => 'required|numeric',
            // 'leverage_commission' => 'required|numeric',
            // 'coinone_decimal' => 'required|numeric',
            // 'cointwo_decimal' => 'required|numeric',
            // 'orderlist' => 'required|numeric',
            // 'referral_commission' => 'required|numeric',
            // 'percentprice' => 'required|numeric',
            // 'b_status' => 'required',
            // 'is_deposit' =>'required',
            // 'is_withdraw' => 'required',

        ]);

        // if ($validator->fails()) {
        //     return back()->with('error',$validator->errors());
        // }

        if ($validator->fails()) {
            // Get all error messages
            $errors = $validator->errors()->all();

            // Get the first error message
            $firstError = $errors[0];

            // Redirect back with the first error message
            return back()->with('error', $firstError);
        }

        $coinone = $request->coinone; 
        $cointwo = $request->cointwo; 
        if($coinone != $cointwo){
            $tradepair =  Tradepair::on('mysql2')->where(['coinone' => $coinone,'cointwo' => $cointwo])->count();
            if($tradepair == 0){
                $Tradepair = new Tradepair();
                $Tradepair->coinone = $coinone; 
                $Tradepair->cointwo = $cointwo;
                $Tradepair->min_price = $request->min_price;
                $Tradepair->max_price = $request->max_price;
                $Tradepair->average_price = $request->average_price;
                $Tradepair->symbol  = $request->symbol !='' ? $request->symbol   : $coinone.$cointwo;
                $Tradepair->active  = $request->status;

                // $Tradepair->min_buy_price = $request->min_buy_price;
                // $Tradepair->min_buy_amount = $request->min_buy_amount;
                // $Tradepair->min_sell_price = $request->min_sell_price;
                // $Tradepair->min_sell_amount = $request->min_sell_amount;
                // $Tradepair->buy_trade = $request->buy_trade;
                // $Tradepair->sell_trade = $request->sell_trade;
                // $Tradepair->leverage_commission = (double)$request->leverage_commission;
                // $Tradepair->coinone_decimal = $request->coinone_decimal;
                // $Tradepair->cointwo_decimal = $request->cointwo_decimal;
                // $Tradepair->is_spot = $request->s_status;
                // $Tradepair->is_dust = $request->b_status;
                // $Tradepair->type = $request->b_status;
                // $Tradepair->is_market = $request->p_status;
                // $Tradepair->start_buy_price = $request->start_buy_price;
                // $Tradepair->end_buy_price = $request->end_buy_price;
                // $Tradepair->start_sell_price = $request->start_sell_price;
                // $Tradepair->end_sell_price = $request->end_sell_price;
                // $Tradepair->start_volume = $request->s_vol;
                // $Tradepair->end_volume= $request->e_vol;
                // $Tradepair->decimal_point = $request->decimal_point;
                // $Tradepair->is_deposit = $request->is_deposit;
                // $Tradepair->is_withdraw = $request->is_withdraw;


                // $Tradepair->is_bot= $request->is_bot;
                // $Tradepair->percentprice  = $request->percentprice;
                // $Tradepair->referral_commission  = $request->referral_commission;
                // $Tradepair->orderlist  = $request->orderlist ? $request->orderlist : Tradepair::count() + 1;
                $Tradepair->save();

                //$this->generateBotTrade($Tradepair->id);
                return back()->with('status','Trade Pair Added Successfully');

            }else{
                return back()->with('error','Trade pair already exits!');
            }
        }else{
            return back()->with('error','Please select different pair!');
        }

   
    }

    public function pairupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coinone' => 'required|max:50',
            'cointwo' => 'required|max:50',
            'min_price' => 'required',
            'max_price' => 'required',
            'average_price' => 'required',
            'status' =>'required',

            // 'coinone' => 'required|max:50',
            // 'cointwo' => 'required|max:50',
            // 'activestatus' => 'required|numeric',
            // 'min_buy_price' => 'required|numeric',
            // 'min_buy_amount' => 'required|numeric',
            // 'min_sell_price' => 'required|numeric',
            // 'min_sell_amount' => 'required|numeric',
            // 'buy_trade' => 'required|numeric',
            // 'sell_trade' => 'required|numeric',
            // 'leverage_commission' => 'required|numeric',
            // 'coinone_decimal' => 'required|numeric',
            // 'cointwo_decimal' => 'required|numeric',
            // 'orderlist' => 'required|numeric',
            // 'referral_commission' => 'required|numeric',
            // 'percentprice' => 'required|numeric',
            // 'b_status' => 'required',
            // 'is_deposit' => 'required',
            // 'is_withdraw' => 'required',
            // 'walletpair' =>'required'
        ]);

        if ($validator->fails()) {
            // Get all error messages
            $errors = $validator->errors()->all();

            // Get the first error message
            $firstError = $errors[0];

            // Redirect back with the first error message
            return back()->with('error', $firstError);
        }
    

        $coinone = $request->coinone; 
        $cointwo = $request->cointwo; 
        $activestatus = $request->status; 
        $id = $request->id;
        if($coinone != $cointwo){
            $tradepair =  Tradepair::on('mysql2')->where([['id' ,'!=',$id] ,['coinone' ,'=', $coinone],['cointwo' ,'=', $cointwo]])->count();

            if($tradepair == 0){
                $Tradepair = Tradepair::on('mysql2')->where('id',$id)->first();
                $Tradepair->coinone = $coinone; 
                $Tradepair->cointwo = $cointwo;
                
                // $Tradepair->walletpair =$request->walletpair;
                $Tradepair->min_price = $request->min_price;
                $Tradepair->max_price = $request->max_price;
                $Tradepair->average_price = $request->average_price;
                $Tradepair->symbol  = $request->symbol !='' ? $request->symbol   : $coinone.$cointwo;
                $Tradepair->active  = $activestatus;

                // $Tradepair->min_sell_amount = $request->min_sell_amount;
                // $Tradepair->buy_trade = $request->buy_trade;
                // $Tradepair->sell_trade = $request->sell_trade;
                // $Tradepair->leverage_commission = (double)$request->leverage_commission;
                // $Tradepair->coinone_decimal = $request->coinone_decimal;
                // $Tradepair->cointwo_decimal = $request->cointwo_decimal;
                // if (isset($$request->symbol) && $request->symbol !=''){
                //     $Tradepair->symbol = $request->symbol;
                // }else {
                //     $Tradepair->symbol  = $coinone.$cointwo;
                // }
                // $Tradepair->is_spot = $request->s_status;
                // $Tradepair->is_dust = $request->b_status;
                // $Tradepair->type = $request->b_status;
                // $Tradepair->is_market = $request->p_status;
                // $Tradepair->start_buy_price = $request->start_buy_price;
                // $Tradepair->end_buy_price = $request->end_buy_price;
                // $Tradepair->start_sell_price = $request->start_sell_price;
                // $Tradepair->end_sell_price = $request->end_sell_price;
                // $Tradepair->start_volume = $request->s_vol;
                // $Tradepair->end_volume= $request->e_vol;
                // $Tradepair->decimal_point = $request->decimal_point;
                // $Tradepair->is_deposit = $request->is_deposit;
                // $Tradepair->is_withdraw = $request->is_withdraw;


                // $Tradepair->is_bot= $request->is_bot;
                // $Tradepair->orderlist = $request->orderlist;
                
                // $Tradepair->percentprice  = $request->percentprice;
                // $Tradepair->referral_commission  = $request->referral_commission;
                $Tradepair->save();
                //$this->generateBotTrade($id);
                return back()->with('status','Trade Pair Updated Successfully');
            }else{
                return back()->with('error','Trade pair already exits!');
            }
        }else{
            return back()->with('error','Please select different pair!');
        }

    }
    public function generateBotTrade($id){

        $trades = Tradepair::where(['is_bot' => 1,'id' => $id])->get();
        if(count($trades) > 0){
            foreach($trades as $trade){
                $PID = $trade->id;
                TradeBot::where('pair',$PID)->delete();
                $startBuyPrice = $trade->start_buy_price;
                $endBuyPrice = $trade->end_buy_price;
                $startSellPrice = $trade->start_sell_price;
                $endSellPrice = $trade->end_sell_price;
                $startVolume = $trade->start_volume;
                $endVolume = $trade->end_volume;
                $coinone_decimal = $trade->coinone_decimal;
                $cointwo_decimal = $trade->cointwo_decimal;
                for($i=1;$i<=10;$i++){
                    $type = "Buy";
                    $price = $this->randomDecimal($startBuyPrice,$endBuyPrice,$cointwo_decimal);
                    $volume = $this->randomDecimal($startVolume,$endVolume,$coinone_decimal);
                    $value = ncMul($price,$volume,$cointwo_decimal);
                    $orderId = TransactionString(20);
                    $botTrade = new TradeBot;
                    $botTrade->trade_type = $type;
                    $botTrade->pair = $PID;
                    $botTrade->order_type = 1;
                    $botTrade->price = $price;
                    $botTrade->volume = $volume;
                    $botTrade->value = $value;
                    $botTrade->fees = 0;
                    $botTrade->commission = 0;
                    $botTrade->remaining = $botTrade->volume;
                    $botTrade->created_at = date('Y-m-d H:i:s',time());
                    $botTrade->save();
                    //dd($botTrade);
                }
                for($i=1;$i<=10;$i++){
                    $type = "Sell";
                    $price = $this->randomDecimal($startSellPrice,$endSellPrice,$cointwo_decimal);
                    $volume = $this->randomDecimal($startVolume,$endVolume,$coinone_decimal);
                    $value = ncMul($price,$volume,$cointwo_decimal);
                    $orderId = TransactionString(20);
                    $botTrade = new TradeBot;
                    $botTrade->trade_type = $type;
                    $botTrade->pair = $PID;
                    $botTrade->order_type = 1;
                    $botTrade->price = $price;
                    $botTrade->volume = $volume;
                    $botTrade->value = $value;
                    $botTrade->fees = 0;
                    $botTrade->commission = 0;
                    $botTrade->remaining = $botTrade->volume;
                    $botTrade->created_at = date('Y-m-d H:i:s',time());
                    $botTrade->save();
                    //dd($botTrade);
                }
                return "Done";
            }

        }
    }
    /**
     * @param float $min
     * @param float $max
     * @param int $digit
     * @return float|int
     */
    public function randomDecimal(float $min, float $max, int $digit = 2)
    {
        $num = $min + lcg_value() * ($max - $min);
        return $randomFloat = sprintf('%.'.$digit.'f', $num);
        //return mt_rand($min  10, $max  10) / pow(10, $digit);
    }

    public function coinDelete($id){
        $id  = Crypt::decrypt($id);
        $commission = Commission::on('mysql2')->where('id', $id)->first();
        if($commission){
           $coin    = $commission->source;

           $coinones = Tradepair::on('mysql2')->where([['coinone' ,'=', $coin]])->get(); 
        //    if(count($coinones) > 0){
        //         foreach ($coinones as $coinone) {
        //             BuyTrades::on('mysql2')->where([['pair', '=', $coinone->id]])->delete();
        //             SellTrades::on('mysql2')->where([['pair', '=', $coinone->id]])->delete();
        //         }
                $coinones = Tradepair::on('mysql2')->where([['coinone' ,'=', $coin]])->delete();
        //    } 
           $cointwos = Tradepair::on('mysql2')->where([['cointwo' ,'=', $coin]])->get();
        //    if(count($cointwos) > 0){
        //         foreach ($cointwos as $cointwo) {
        //             BuyTrades::on('mysql2')->where([['pair', '=', $cointwo->id]])->delete();
        //             SellTrades::on('mysql2')->where([['pair', '=', $cointwo->id]])->delete();
        //         }
                $cointwos = Tradepair::on('mysql2')->where([['cointwo' ,'=', $coin]])->delete();
        //    } 
           Commission::on('mysql2')->where('id', $id)->delete();
           return back()->with('status','Token Delete Successfully');
        }
        return back()->with('error','Invalid Token ');

    }

    public function tradepairDelete($id){

        $id  = Crypt::decrypt($id);
        
        $commission = Tradepair::on('mysql2')->where('id',$id)->first();
        
        if($commission){
        //    Trades::on('mysql2')->where('pair',$id)->delete();
        //    $completedTrades = Completedtrade::on('mysql2')->where('pair',$id)->first();
        //    if($completedTrades){
        //     Completedtrade::on('mysql2')->where('pair',$id)->delete();
        //    }
           
           $coinones = Tradepair::on('mysql2')->where('id',$id)->delete();

           return back()->with('status','Token Delete Successfully');
        }
        return back()->with('error','Invalid Trade Pair');

    }

}
