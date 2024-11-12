<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Commission;
use App\Models\Coinwithdraw;
use App\Models\Cryptotransaction;
use App\Models\SellRequest;
use Auth;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Walletcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function deposit($coin)
    {
        try {
            $coin = strtoupper($coin);
            $coins = Commission::where([['source', '=', $coin], ['shown', '=', 1]])->orderBy('type', 'asc')->first();
            $uid = Auth::user()->id;
            if (is_object($coins)) {

                if ($coins->is_deposit === 0) {
                    return redirect('deposit')->with('error', 'Currently disable deposit for ' . $coin);
                }
                $trxaddress = Wallet::where(['uid' => $uid, 'currency' => 'TRX'])->value('mukavari');
                return view('deposit.deposit-inner', ['trxaddress' => $trxaddress]);
            } else {
                return redirect('/deposit')->with('adminwalletbank', 'Invalid Coin/Currency');
            }
        } catch (\Exception $exception) {

        }

    }

    public function cryptoWithdraw(Request $request)
    {
        $this->validate($request, [
            'address' => 'required',
            'amount' => 'required|numeric',
        ]);

        $uid = \Auth::id();
        $currency = 'USDT';
        $network = 'trxtoken';

        $trxCoin = Commission::where(['source' => $currency, 'type' => $network])->first();
        if ($trxCoin) {

            $this->validate($request, [
                'address' => 'required|regex:/^T[a-zA-Z0-9]{33}$/',
            ]);

            $amount = abs($request->amount);

            if ($trxCoin->com_type == 'Fixed') {
                $fee = $trxCoin->withdraw;
                $debitamt = ncSub($amount, $fee, 8);
            } else {
                $commission = ncDiv($trxCoin->withdraw, 100);
                $fee = ncMul($amount, $commission, 8);
                $debitamt = ncSub($amount, $fee, 8);
            }

            $to_address = $request->address;
            //dd($to_address);
            $balance = 0;
            $balance = Wallet::where([['uid', '=', $uid], ['currency', $currency]])->value('balance');
            $min_withdraw = $trxCoin->min_withdraw;
            $perday_withdraw = $trxCoin->perday_withdraw;
            $type = $trxCoin->type;
            $TodaywithdrawAmount = Coinwithdraw::where(['uid' => $uid, 'coin_name' => $currency])->whereIn('status', [0, 1])->whereRaw('Date(created_at) = CURDATE()')->sum('amount');
            $bankid = NULL;

            $findminmumwithdrawamount = bcsub($perday_withdraw, $TodaywithdrawAmount, 8);
            if ($amount >= $min_withdraw and $amount > 0) {

                if ($findminmumwithdrawamount >= $amount) {
                    if ($to_address != "") {
                        if ($balance >= $amount) {
                            $network = "TRC20";
                            $mtype = 'Web';
                            $liveprice = 0;

                            $fromaddress = Wallet::where(['currency' => 'TRX', 'uid' => \Auth::id()])->value('mukavari');
                            $internal_trans = Wallet::where([['uid', '!=', $uid], ['mukavari', '=', $to_address]])->first();
                            if (isset($internal_trans)) {

                                $uid1 = $internal_trans->uid;
                                $currency = $internal_trans->currency;
                                $txid = TransactionString() . $uid1;
                                $confirm = 1;
                                $time = date("Y-m-d H:i:s");
                                $status = 1;
                                $nirvaki_nilai = 99;
                                $internal = 1;
                                $remark = "User " . $currency . " withdraw request";
                                Cryptotransaction::createTransaction($uid1, $currency, $txid, $fromaddress, $to_address, $amount, $confirm, $time, $status, $nirvaki_nilai);
                                $inserid = Coinwithdraw::createTransaction($uid, $currency, $fromaddress, $to_address, $amount, $fee, $debitamt, 1, $network, null);
                                Wallet::creditAmount($uid1, $currency, $amount, 8, 'withdraw', $remark, $inserid);

                            } else {

                                $internal = 0;
                                $inserid = Coinwithdraw::createTransaction($uid, $currency, $fromaddress, $to_address, $amount, $fee, $debitamt, 0, $network, null);

                            }

                            $remark = "User " . $currency . " withdraw request";
                            $wallet = Wallet::debitAmount($uid, $currency, $amount, 8, 'withdraw', $remark, $inserid);
                            return redirect('/exchange-history-withdraw')->with('success', "Withdraw successful!");

                        } else {
                            return redirect('withdraw')->with('error', "Insufficient fund in your $currency Wallet !!!.You need " . display_format($amount, 8) . " " . $currency);
                        }
                    } else {
                        return redirect('withdraw')->with('error', "To Address Invalid");
                    }
                } else {
                    return redirect('withdraw')->with('error', "Per day withdraw request amount  only " . display_format($perday_withdraw, 8) . "  " . $currency);
                }
            } else {
                return redirect('withdraw')->with('error', "Withdraw amount must be greater than or equal to " . display_format($min_withdraw, 8) . "  " . $currency);
            }
        }
    }

    public function history()
    {
        return view('history.history');
    }

}
