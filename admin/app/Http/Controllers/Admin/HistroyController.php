<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\Models\CryptoTransactions;
use App\Models\Deposit;
use App\Models\CurrencyDeposit;
use App\Models\Commission;
use App\Models\CurrencyWithdraw;
use App\Models\CoinWithdraw;
use App\Models\Bank;
use App\Models\Countries;
use App\Models\Instantuser;
use App\Models\InstantBuyTrades;
use App\Models\InstantSellTrades;
use App\Models\Tradepair;
use App\Models\Adminwallet;
use App\Models\AdminTransactions;
use App\Exports\DepositExport;
use App\Exports\WithdrawExport;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;

class HistroyController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function DepositList($coin)
    {
        $details = Commission::coindetails($coin);
        if ($details) {
            if ($details->type == 'fiat') {
                $DepositList = Deposit::depsoitListall($coin);
                return view('userdeposit.fiat_deposit', ['deposit' => $DepositList, 'coin' => $coin, 'q' => '']);
            } else {
                $DepositList = CryptoTransactions::depsoitListall($coin);
                return view('userdeposit.crypto_deposit', ['depositList' => $DepositList, 'coin' => $coin, 'q' => '']);
            }
        } else {
            return redirect('/')->with('error', 'Invalid Coin/Currency');
        }
    }
    public function exportDeposit($key)
    {
        if ($key == 'day') {
            $histroys = Cryptotransactions::on('mysql2')->whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->get();
        }
        if ($key == 'week') {
            $histroys = Cryptotransactions::on('mysql2')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('id', 'desc')->get();
        }
        if ($key == 'month') {
            $histroys = Cryptotransactions::on('mysql2')->whereMonth('created_at', Carbon::now()->month)->orderBy('id', 'desc')->get();
        }
        return Excel::download(new DepositExport($histroys), 'DepositData.xlsx');
    }
    // public function DepositSearchList(Request $request)
    // {   
    //     $q = $request;
    //     $searchitem =$request->searchitem;
    //     // $q = $request->searchitem;
    //     $coin = $request->coin;
    //     $details = Commission::coindetails($coin);
    //     if($details){
    //         if($details->type == 'fiat'){
    //             $DepositList = Deposit::depsoitListall($coin);        
    //             return view('userdeposit.fiat_deposit',['deposit' => $DepositList,'coin' => $coin, 'q' => $searchitem]);
    //         }else{
    //             $DepositList = CryptoTransactions::user_name_search($q,$searchitem);
    //             return view('userdeposit.crypto_deposit',['depositList' => $DepositList,'coin' => $coin,'q'=> $searchitem]);
    //         }
    //     }else{
    //         return redirect('/')->with('error','Invalid Coin/Currency');
    //     }
    // }



    public function DepositSearchList(Request $request)
    {
        $q = $request;
        $searchitem = $request->searchitem;
        $coin = $request->coin;
        $status = $request->status; // Get the status from the request

        $details = Commission::coindetails($coin);
        if ($details) {
            if ($details->type == 'fiat') {
                $DepositList = Deposit::user_name_search($q, $searchitem, $status);
                return view('userdeposit.fiat_deposit', [
                    'deposit' => $DepositList,
                    'coin' => $coin,
                    'q' => $searchitem
                ]);
            } else {
                $DepositList = CryptoTransactions::user_name_search($q, $searchitem, $status);
                return view('userdeposit.crypto_deposit', [
                    'depositList' => $DepositList,
                    'coin' => $coin,
                    'q' => $searchitem
                ]);
            }
        } else {
            return redirect('/')->with('error', 'Invalid Coin/Currency');
        }
    }



    public function InstantList($type)
    {


        $details = Instantuser::where('type', $type)->orderBy('id', 'desc')->paginate(15);
        if ($details) {
            return view('instant.history', ['Instanthistory' => $details, 'type' => $type]);
        } else {
            return redirect('/')->with('error', 'Invalid Coin/Currency');
        }
    }

    public function CryptoDepositEdit($id)
    {
        $transfer_id = Crypt::decrypt($id);

        $btcDeposit = CryptoTransactions::depsoitView($transfer_id);

        return view('userdeposit.crypto_deposit_edit')->with('deposit', $btcDeposit);
    }

    public function CryptoDepositUpdate(Request $request)
    {
        $Deposit = CryptoTransactions::depsoitUpdate($request);
        if ($Deposit) {
            return back()->with('status', 'Deposit Updated Successfully');
        } else {
            return back()->with('status', 'Deposit Updated Failed');
        }
    }
    public function FiatDepositList()
    {
        $usdDepositList = CurrencyDeposit::depsoitList('USD');

        return view('userdeposit.usd_deposit')->with(['deposit' => $usdDepositList]);
    }

    public function FiatDepositEdit($id)
    {
        $depositList = Deposit::depsoitView(Crypt::decrypt($id));

        return view('userdeposit.deposit_edit')->with(['deposit' => $depositList]);
    }


    public function FiatDepositUpdate(Request $request)
    {

        if ($request->credit_amount > 0  && $request->status > 0) {
            $depositUpdate = Deposit::statusUpdate($request);

            return back()->with('success', 'Deposit Updated Successfully!');
        } else {
            return back()->with('error', 'Please Enter the Credit Amount or status!');
        }
    }

    //Withdraw Histroy
    public function WithdrawList($coin)
    {
        $details = Commission::coindetails($coin);

        if ($details) {
            if ($details->type == 'fiat') {
                $crypto_trasnaction = CurrencyWithdraw::histroy($details->source);
                return view('userwithdraw.fiat_withdraw', ['currency' => $coin, 'transaction' => $crypto_trasnaction, 'q' => '']);
            } else {
                $btcWithdraw = CoinWithdraw::histroy($coin);
                return view('userwithdraw.crypto_withdraw', ['currency' => $coin, 'transaction' => $btcWithdraw, 'q' => '']);
            }
        } else {
            return redirect('/')->with('error', 'Invalid Coin/Currency');
        }
    }
    //Fiat Withdraw
    public function exportWithdraw($key)
    {
        if ($key == 'day') {
            $histroys = CoinWithdraw::on('mysql2')->whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->get();
        }
        if ($key == 'week') {
            $histroys = CoinWithdraw::on('mysql2')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('id', 'desc')->get();
        }
        if ($key == 'month') {
            $histroys = CoinWithdraw::on('mysql2')->whereMonth('created_at', Carbon::now()->month)->orderBy('id', 'desc')->get();
        }
        // dd($histroys);

        // $histroys = CoinWithdraw::on('mysql2')->whereBetween('created_at',array($start.'00:00:00',$end.'23:59:59'))->orderBy('id', 'desc')->get(); 
        return Excel::download(new WithdrawExport($histroys), 'WithdrawData.xlsx');
    }

    // public function WithdrawSearchList(Request $request)
    // {
    //     $q = $request->searchitem;
    //     $coin = $request->coin;
    //     $details = Commission::coindetails($coin);
    //     if ($details) {
    //         if ($details->type == 'fiat') {
    //             $crypto_trasnaction = CurrencyWithdraw::histroy($details->source);
    //             return view('userwithdraw.fiat_withdraw', ['currency' => $coin, 'transaction' => $crypto_trasnaction, 'q' => $q]);
    //         } else {
    //             $btcWithdraw = CoinWithdraw::user_name_search($q, $coin);
    //             return view('userwithdraw.crypto_withdraw', ['currency' => $coin, 'transaction' => $btcWithdraw, 'q' => $q]);
    //         }
    //     } else {
    //         return redirect('/')->with('error', 'Invalid Coin/Currency');
    //     }
    // }



    public function WithdrawSearchList(Request $request)
    {
        $searchitem = $request->searchitem;
        $coin = $request->coin;
        $status = $request->status; // Get the status from the request

        // Retrieve coin details based on the provided coin
        $details = Commission::coindetails($coin);

        if ($details) {
            if ($details->type == 'fiat') {
                // If coin type is fiat, retrieve history for currency withdrawal
                $crypto_transaction = CurrencyWithdraw::user_name_search($request, $searchitem, $status);
                return view('userwithdraw.fiat_withdraw', [
                    'currency' => $coin,
                    'transaction' => $crypto_transaction,
                    'q' => $searchitem,
                    'status' => $status
                ]);
            } else {
                // For crypto, retrieve history for coin withdrawal
                $btcWithdraw = CoinWithdraw::user_name_search($request, $searchitem, $status);
                return view('userwithdraw.crypto_withdraw', [
                    'currency' => $coin,
                    'transaction' => $btcWithdraw,
                    'q' => $searchitem,
                    'status' => $status
                ]);
            }
        } else {
            // Redirect back with error if coin details are invalid
            return redirect('/')->with('error', 'Invalid Coin/Currency');
        }
    }






    public function withdrawFiatEdit($id)
    {
        $crypto_trasnaction = CurrencyWithdraw::edit(Crypt::decrypt($id));
        $Countries = Countries::get();
        $bank = Bank::on('mysql2')->where('id', $crypto_trasnaction->bank_id)->first();

        return view('userwithdraw.withdraw_edit', ['withdraw' => $crypto_trasnaction, 'bank' => $bank, 'Countries' => $Countries]);
    }

    public function withdrawFiatUpdate(Request $request)
    {

        $crypto_trasnaction = CurrencyWithdraw::withdrawUpdate($request);

        return back()->with('status', 'Withdraw Updated Successfully');
    }
    //Crypto Withdraw
    public function WithdrawCryptoEdit($id)
    {

        $id = \Crypt::decrypt($id);
        $withdraw = CoinWithdraw::edit($id);

        return view('userwithdraw.cryptowithdraw_edit', [
            'withdraw' => $withdraw
        ]);
    }



    public function updateCryptoWithdraw(Request $request)
    {
        $withdraw = CoinWithdraw::withdrawUpdate($request);

        return back()->with('status', $withdraw);
    }


    public function instantbuytradehistory(Request $request)
    {

        $pair = explode('_', $request->pair);
        $type = $request->type;
        $error_msg = '';
        $error = '';
        if ((!empty($pair[0])) && (!empty($pair[1]))) {
            $tradepair = Tradepair::index($pair[0], $pair[1]);
            if ($tradepair) {
                $tradepair = $tradepair;
            } else {
                $tradepair = Tradepair::first();
                Session::flash('error', "Invalid Coin Pairs !");
            }
        } else {
            $tradepair = Tradepair::first();
            Session::flash('error', "Invalid Coin Pairs !");
        }

        $pairs = Tradepair::pair();

        $buytrade = InstantBuyTrades::buyTradesHistory($tradepair->id);

        return view('instanttradehistory.buytradehistory', ['buytrade' => $buytrade, 'tradepair' => $tradepair, 'pairs' => $pairs]);
    }

    public function instantselltradehistory(Request $request)
    {
        $pair = explode('_', $request->pair);
        $type = $request->type;

        $error_msg = 'error';
        $error = 'error';

        if ((!empty($pair[0])) && (!empty($pair[1]))) {
            $tradepair = Tradepair::index($pair[0], $pair[1]);
            if ($tradepair) {
                $tradepair = $tradepair;
            } else {
                $tradepair = Tradepair::first();
                Session::flash('error', "Invalid Coin Pairs !");
            }
        } else {
            $tradepair = Tradepair::first();
            Session::flash('error', "Invalid Coin Pairs !");
        }


        $pairs = Tradepair::pair();

        $selltrades = InstantSellTrades::sellTradesHistory($tradepair->id);

        return view('instanttradehistory.selltradehistory', ['selltrade' => $selltrades, 'tradepair' => $tradepair, 'pairs' => $pairs]);
    }

    public function depositexport()
    {

        $list = CryptoTransactions::on('mysql2')->orderBy('id', 'desc')->get();
        return view('overall.deposit', ['data' => $list]);
    }
    public function withdrawexport()
    {
        $histroy = CoinWithdraw::on('mysql2')->orderBy('id', 'desc')->get();
        return view('overall.withdraw', ['data' => $histroy]);
    }

    public function commissionwallethistory()
    {
        $history = Adminwallet::on('mysql2')->paginate(10);
        return view('commissionwallethistory', ['history' => $history]);
    }

    public function commissionhistory()
    {
        $history = AdminTransactions::on('mysql2')->paginate(10);
        // echo "<pre>";print_r($history);exit;
        return view('commissionhistory', ['history' => $history]);
    }
}
