<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tradepair;
use App\Models\BuyTrades;
use App\Models\SellTrades;
use App\Models\Completedtrade;
use App\Models\UserWallet;
use App\Models\CryptoTransactions;
use App\Models\BuySellCommission;
use App\Models\Adminwallet;
use App\Models\AffliateTransaction;
use App\Models\MarketPlace;
use App\Models\MatchHistory;
use App\Models\User;

class TradesController extends Controller
{
    public function buyTradeHistory(Request $request)
    {

        $pair = "";
        $tradepair = "";
        $tradepair_id = "";
        $order_type = "";
        $type = $request->tradetype;
        
        if($request->tradetype != "" || $request->tradepairname != ""){
            
            if($request->tradepairname != ""){
                $pair = explode('_', $request->tradepairname);
                $tradepair = Tradepair::index($pair[0], $pair[1]);
                $tradepair_id = $tradepair->id;
            }
            else{
                $pair = "";
                $tradepair = "";
                $tradepair_id = "";
            }
            
            if($type == 'limit')
            {
                $order_type = 1;
            } else if($type == 'market'){
                $order_type = 2;
            }
            else{
                $order_type = "";
            }
            
            $buytrade = BuyTrades::on('mysql2')
            ->where('trade_type' ,'=','Buy')
            ->where('status' ,'!=',0)
            ->where(function($data) use ($tradepair,$order_type,$tradepair_id){
                if($order_type != ""){
                    $data->where('order_type', '=', $order_type);
                }
                if($tradepair_id != ""){
                    
                    $data->where('pair', '=', $tradepair_id);
                }
            })
            ->orderBy('id', 'desc')->paginate(15);
            
        }
        else{

            $buytrade = BuyTrades::on('mysql2')
            ->where('trade_type' ,'=','Buy')
            ->where('status' ,'!=',0)
            ->orderBy('id', 'desc')->paginate(15);
        }
	    
	    $pairs = Tradepair::pair();

		return view('tradehistory.buytradehistory', ['buytrade' => $buytrade,'tradepair' => $tradepair,'order_type'=> $order_type,'pairs'=> $pairs,'type' => $type]);
    }

    public function sellTradeHistory(Request $request)
	{

        $pair = "";
        $tradepair = "";
        $tradepair_id = "";
        $order_type = "";
        $type = $request->tradetype;
        
        if($request->tradetype != "" || $request->tradepairname != ""){
            
            if($request->tradepairname != ""){
                $pair = explode('_', $request->tradepairname);
                $tradepair = Tradepair::index($pair[0], $pair[1]);
                $tradepair_id = $tradepair->id;
            }
            else{
                $pair = "";
                $tradepair = "";
                $tradepair_id = "";
            }
            
            if($type == 'limit')
            {
                $order_type = 1;
            } else if($type == 'market'){
                $order_type = 2;
            }
            else{
                $order_type = "";
            }
            
            $selltrades = SellTrades::on('mysql2')
            ->where('trade_type' ,'=','Sell')
            ->where('status' ,'!=',0)
            ->where(function($data) use ($tradepair,$order_type,$tradepair_id){
                if($order_type != ""){
                    $data->where('order_type', '=', $order_type);
                }
                if($tradepair_id != ""){
                    
                    $data->where('pair', '=', $tradepair_id);
                }
            })
            ->orderBy('id', 'desc')->paginate(15);
            
        }
        else{

            $selltrades = SellTrades::on('mysql2')
            ->where('trade_type' ,'=','Sell')
            ->where('status' ,'!=',0)
            ->orderBy('id', 'desc')->paginate(15);
        }
	    
	    $pairs = Tradepair::pair();

	    // $pair = explode('_', $request->pair);
	    // $type = $request->type;
	    // $order_type = 2;
	    // if($type == 'limit')
	    // {
	    //     $order_type = 1;
	    // } else {
	    // 	$type == 'market';
	    // 	$order_type = 2;
	    // }
	    
	    // $tradepair = Tradepair::index($pair[0], $pair[1]);

	    // $pairs = Tradepair::pair();

		// $selltrades = SellTrades::sellTradesHistory($order_type,$tradepair->id);

		return view('tradehistory.selltradehistory', ['selltrade' => $selltrades,'tradepair' => $tradepair,'order_type'=>$order_type,'pairs'=>$pairs,'type' => $type]);	
	}
	
	 public function Admininstanttransaction(Request $request)
    {

		$Instanthistory = Adminwallet::paginate(10);

		return view('adminhistory.history', ['Instanthistory' => $Instanthistory]);
    }
     public function affliatetransaction(Request $request)
    {
		$Affliate = AffliateTransaction::affliateHistory();

		return view('affliatehistory.history', ['Affliate' => $Affliate]);
    }

      public function pendingTradeHistory(Request $request)
	{
		$type = $request->pair;
		if(isset($request->otype)){
			$otype = $request->otype;
		}else{
			$otype = 'Buy';
		}
		
		if($otype == 'Buy'){
			if($request->pair == 'all'){
				$myorders = BuyTrades::where([['trade_type' ,'=','Buy'],['status', '=', 0],['order_type', '!=', 2]])->orderBy('id', 'desc')->paginate(30);
			}else{
				$pair = explode('_', $request->pair);
				$pairtype = Tradepair::index($pair[0], $pair[1]);
				$pairid = $pairtype->id;
				$myorders = BuyTrades::where([['trade_type' ,'=','Buy'],['status', '=', 0],['order_type', '!=', 2],['pair','=',$pairid]])->orderBy('id', 'desc')->paginate(30);
			}
		}else{
			if($request->pair == 'all'){
				$myorders = SellTrades::where([['trade_type' ,'=','Sell'],['status', '=', 0],['order_type', '!=', 2]])->orderBy('id', 'desc')->paginate(30);
			}else{
				$pair = explode('_', $request->pair);
				$pairtype = Tradepair::index($pair[0], $pair[1]);
				$pairid = $pairtype->id;
				$myorders = SellTrades::where([['trade_type' ,'=','Sell'],['status', '=', 0],['order_type', '!=', 2],['pair','=',$pairid]])->orderBy('id', 'desc')->paginate(30);
			}
		}
        $pairs = Tradepair::pair();
		return view('tradehistory.pendingtradehistory', ['trades' => $myorders,'pairs'=>$pairs,'type' => $type,'ordertype' => $otype]);	
	}
	public function cancelbuyorder($id) {

        $id = $id;
        
        // Buy Trade
        $buytrades = BuyTrades::where(['id' => $id,'status' => 0])->first();
        if ($buytrades) {
        	$uid 		= $buytrades->uid;
            $price      = $buytrades->price;
            $volume     = $buytrades->remaining;
           // $spend      = $buytrades->spend;
            $leverage   = $buytrades->leverage;
            $trdepair   = Tradepair::where([['id', '=', $buytrades->pair]])->first();
            $currency   = $trdepair->cointwo;
            $commission = $buytrades->commission;
            $value      = ncAdd($buytrades->value, $buytrades->fees,8);
            $selled     = 0;

            if($buytrades->order_type !=2) {
                $selled = Completedtrade::where('buytrade_id', $buytrades->id)->sum('value');
                $selledcom = ncMul($selled,$commission,8);
                $selltotal = ncAdd($selled,$selledcom,8);
                $total = ncSub($value,$selltotal,8);
                $value  = ncSub($buytrades->value, $selled, 8);
            }
            $fee        = ncAdd($buytrades->fees, $value, 8);
            $leve_bal = 0;  

            $pairname   = $trdepair->coinone."/".$trdepair->cointwo; 
          
           


            $buytrades->status = 100;
            $buytrades->save();

             $this->creditAmountPending($uid, $currency, $total, $fee,$leve_bal,'buy',$pairname,$buytrades->id);

            $url = "/admin/pending_tradehistory/".$trdepair->coinone."_".$trdepair->cointwo."/Buy";
         
            \Session::flash('cancelsuccess', 'Pending order cancelled successfully!');
            return redirect($url)->with('cancelsuccess','Pending order cancelled successfully!');



        } else {
            return redirect()->back()->withErrors('cancelerror', 'Bad Request!');
        }
    }

    public function cancelsellorder($id) {

        $id = $id;
        // Buy Trade
        $selltrades = SellTrades::where(['id' => $id,'status' => 0])->first();
        if ($selltrades) {
        	$uid 		= $selltrades->uid;
            $volume     = $selltrades->remaining;
            //$spend      = $selltrades->spend;
            $leverage   = $selltrades->leverage;
            $trdepair   = Tradepair::where([['id', '=', $selltrades->pair]])->first();
            $currency   = $trdepair->coinone;
            $value      = $volume;
            $adminfee   = ncMul($value, $selltrades->commission, 8);
            $total      = ncAdd($value, $adminfee, 8);
            $fee        = ncAdd($selltrades->fees, $value, 8);
            $leve_bal = 0;

            $pairname   = $trdepair->coinone."/".$trdepair->cointwo;
           
            $selltrades->status = 100;
            $selltrades->save();

              $this->creditAmountPending($uid, $currency, $total, $fee,$leve_bal,'sell',$pairname,$selltrades->id);


            $url = "admin/pending_tradehistory/".$trdepair->coinone."_".$trdepair->cointwo."/Sell";
    
             \Session::flash('cancelsuccess', 'Pending order cancelled successfully!');
            return redirect($url)->with('cancelsuccess','Pending order cancelled successfully!');


        } else {
            return redirect()->back()->withErrors('cancelerror', 'Bad Request!');
        }

    }
       public function creditAmountPending($uid, $currency, $balance, $escrow,$leverage,$tradetype=null,$pairname=null,$insertid) {

         $userbalance = UserWallet::where([['uid', '=', $uid], ['currency', '=', $currency]])->first();
        $oldbalance = $userbalance->balance;
        if ($userbalance) {
            //$leverage   = ncSub($userbalance->vilimpu_camanilai,$leverage,8);
            $total      = ncAdd($userbalance->balance,$balance, 8);
            $walletbalance = $total;
            $ecrowtotal = ncSub($userbalance->escrow_balance, $escrow, 8);
            if($ecrowtotal < 0){
                $total = ncAdd($total,$ecrowtotal,8);
                $ecrowtotal = 0;
            }
            $userbalance->balance           = $total;
            $userbalance->escrow_balance    = $ecrowtotal;
            //$userbalance->vilimpu_camanilai = $leverage;
            $userbalance->updated_at        = date('Y-m-d H:i:s',time());
            $userbalance->save();

            //Track trades cancel amount 
            self::AllcoinUpdateBalanceTrack($uid,$currency,$balance,$total,$oldbalance,$tradetype,$pairname,$insertid);
        }
        return true;
    }


    public static function AllcoinUpdateBalanceTrack($uid,$currency,$amount,$walletbalance,$oldbalance,$tradetype=null,$pairname=null,$insertid)
    {
        $Models = '\App\Models\OverallTransaction';
        $remark = 'Admin Cancelled '.$tradetype.' trade in ' .$pairname;
        $type = 'trade';
        $Models::AddTransaction($uid,$currency,$type,$amount,0,$walletbalance,$oldbalance,$remark,$insertid);
        return true;
    }

    public function buyHistory()
    {
        $pairs = Tradepair::pair();
		$buytrade = MarketPlace::where([['trade_type' ,'=', 'Buy']])->whereNotIn('status',[5,6])->orderBy('id', 'desc')->paginate(15);
		return view('p2pmarketplace.buy', ['buytrade' => $buytrade,'pairs'=> $pairs]);
    }

    public function  buyhistoryview($id)
   {
    $id = \Crypt::decrypt($id);
    $trades = MarketPlace::where('id',$id)->first();
     //dd($trades);
    return view('p2pmarketplace.buyview',['trades'=>$trades]);
   }

    public function sellHistory()
    {
	    $pairs = Tradepair::pair();
		$selltrade = MarketPlace::where([['trade_type' ,'=', 'Sell']])->whereNotIn('status',[5,6])->orderBy('id', 'desc')->paginate(15);       
		return view('p2pmarketplace.sell', ['selltrade' => $selltrade,'pairs'=> $pairs]);
    }

    public function  sellhistoryview($id)
   {
    $id = \Crypt::decrypt($id);
    $trades = MarketPlace::where('id',$id)->first();
     //dd($trades);
    return view('p2pmarketplace.sellview',['trades'=>$trades]);
   }

    public function pendingHistory(Request $request)
	{
		$pairs = Tradepair::pair();
		$selltrade = MarketPlace::where([['trade_type' ,'=', 'Sell']])->whereIn('status',[5,6])->paginate(15);       
		return view('p2pmarketplace.allmarket', ['selltrade' => $selltrade,'pairs'=> $pairs]);
	}
    public function p2pViewTrade($id)
    {
        $id = \Crypt::decrypt($id);
        $trades = MarketPlace::where('id',$id)->first();

        return view('p2pmarketplace.tradeedit', ['trades' => $trades]);
    }
    public function p2ptradeupdate(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $remarks = $request->remarks;
        $trade = MarketPlace::where('id',$id)->whereNotIn('status',[4,7,100])->first();
        $sid =$trade->uid;
        $bid =$trade->ouid;
        $seller =User::where('id',$sid)->first();
        $selleremail =$seller->email;
        $buyer =User::where('id',$bid)->first();
        $buyeremail =$buyer->email;

        $coinone = $trade->pair_get['coinone'];
        $cointwo = $trade->pair_get['cointwo'];
        if(is_object($trade)){ 
            if($status == 7){
                $trade->status = 0;
                $trade->is_hold = 0;
                $trade->status_text = 'Pending';
                $trade->remarks = $remarks;
                $trade->save();
                $tid = $trade->tuid;
            //Mail to seller
                    Mail::send('email.p2p.admincancelseller',['seller'=>$seller,'selltrade'=>$trade],function($message) use ($selleremail){
                        $message->subject("Admin Cancelled Your  Match");
                        $message->to($selleremail);
                        });
                //Buyer Update
                $buytrades = MarketPlace::where('id',$tid)->first();
                if(is_object($buytrades)){
                    $buytrades->status = 7;
                    $buytrades->status_text = 'Admin Cancelled';
                    $buytrades->remarks = $remarks;
                    $buytrades->save();
                     //Mail to Buyer
                     Mail::send('email.p2p.admincancelbuyer',['buyer'=>$buyer,'buytrade'=>$buytrades],function($message) use ($buyeremail){
                        $message->subject("Admin Cancelled Your Match");
                        $message->to($buyeremail);
                     });
                }
            }elseif($status == 100){
                $pair = Tradepair::where(['id' => $trade->pair,'active' => 1])->first();
                //Update Seller
                $escrow_volume = $trade->escrow_volume;
                $sellfee = ncMul($escrow_volume, $trade->commission,8);
                $debitamt = ncAdd($trade->escrow_volume,$sellfee);
                UserWallet::clearEscrowAmount($trade->uid, $coinone, $debitamt, 8);

                $remaining = ncSub($trade->remaining,$trade->escrow_volume); 
                if($remaining == 0){
                    $trade->filled = ncAdd($trade->filled,$trade->escrow_volume);
                    $trade->remaining = $remaining;
                    $trade->status = 100;
                    $trade->status_text = 'Completed';
                    //$trade->escrow_volume = 0;
                    $trade->updated_at = date('Y-m-d H:i:s',time());
                    $trade->save();

                    Mail::send('email.p2p.admincompleteseller',['seller'=>$seller,'selltrade'=>$trade],function($message) use ($selleremail){
                        $message->subject("Admin Complete Your Trade");
                        $message->to($selleremail);
                     });

                }else{
                    $trade->filled = ncAdd($trade->filled,$trade->escrow_volume);
                    $trade->remaining = $remaining;
                    $trade->status = 0;
                    $trade->status_text = 'Partialy Filled';
                    $trade->escrow_volume = 0;
                    $trade->is_hold = 0;
                    $trade->updated_at = date('Y-m-d H:i:s',time());
                    $trade->save();

                    Mail::send('email.p2p.admincompleteseller',['seller'=>$seller,'selltrade'=>$trade],function($message) use ($selleremail){
                        $message->subject("Admin Complete Yours Trade");
                        $message->to($selleremail);
                     });
                }
                //Update Buyer
                $getMatch =  MarketPlace::where(['id' => $trade->tuid])->first();

                $remaining = ncSub($getMatch->remaining,$escrow_volume); 
                if($remaining == 0){
                    $getMatch->filled = ncAdd($getMatch->filled,$escrow_volume);
                    $getMatch->remaining = $remaining;
                    $getMatch->status = 100;
                    $getMatch->status_text = 'Completed';
                    //$getMatch->escrow_volume = 0;
                    $getMatch->updated_at = date('Y-m-d H:i:s',time());
                    $getMatch->save();

                    Mail::send('email.p2p.admincompletebuyer',['buyer'=>$buyer,'buytrade'=>$getMatch],function($message) use ($buyeremail){
                        $message->subject("Admin Complete Your Trade");
                        $message->to($buyeremail);
                     });

                }else{
                    $getMatch->filled = ncAdd($getMatch->filled,$escrow_volume);
                    $getMatch->remaining = $remaining;
                    $getMatch->status = 0;
                    $getMatch->status_text = 'Partialy Filled';
                    $getMatch->escrow_volume = 0;
                    $getMatch->is_hold = 0;
                    $getMatch->updated_at = date('Y-m-d H:i:s',time());
                    $getMatch->save();

                    Mail::send('email.p2p.admincompletebuyer',['buyer'=>$buyer,'buytrade'=>$getMatch],function($message) use ($buyeremail){
                        $message->subject("Admin Complete Yours Trade");
                        $message->to($buyeremail);
                     });
                }
                $remark= "P2P Trade complete $coinone / $cointwo";
                $buyfee     = ncMul($escrow_volume, $getMatch->commission,8);
                $creditAmt = ncSub($escrow_volume,$buyfee); 
                UserWallet::creditAmount($getMatch->uid, $coinone, $creditAmt, 8,"buytrade",$remark,$getMatch->id);

                $type = 'Buy';
                $oldprice = MatchHistory::where('pair',$pair->id)->orderBy('id', 'desc')->value('price');
                if($oldprice > $trade->price){
                     $type = 'Sell';
                }

                $complete = new MatchHistory;
                $complete->pair = $pair->id;
                $complete->type = $type;
                $complete->buytrade_id = $getMatch->id;
                $complete->selltrade_id = $trade->id;
                $complete->price = $trade->price;
                $complete->volume = $escrow_volume;
                $complete->value = ncMul($trade->price,$escrow_volume);
                $complete->save();

                $pair->live_price = $trade->price;
                $pair->save();
            }           
            
            return redirect('admin/pendinghistory')->with('success', 'update successfully!');
        }
        return redirect()->back()->withErrors('status', 'update not successfully! may trade already submited');        
    }
}
