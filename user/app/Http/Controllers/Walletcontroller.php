<?php
namespace App\Http\Controllers;

use App\Models\Tradepair;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Commission;
use App\Models\Bankuser;
use App\Models\Coinwithdraw;
use App\Models\Cryptotransaction;
use App\Models\Category;
use App\Models\PurchaseHistory;
use App\Models\WithdrawAddress;
use App\Mail\EmailVerification;
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

    public function exchange()
    {
        try {
            $user = Auth::user();
            $showPop = true;
            if ($user->trans_password) {
                $showPop = false;
            }
            $usdt = Commission::where(['source' => 'USDT', 'shown' => 1])->first();
            $usdtinr = TradePair::where(['symbol' => 'USDTINR'])->first();
            $category = Category::where(['status' => 1])->get();

            return view('exchange.exchange', ['coin' => $usdt, 'pair' => $usdtinr, 'showPopup' => $showPop, 'category' => $category]);
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function transactionPassword()
    {
        try {
            $user = Auth::user();
            if ($user) {

                $otp = rand(100000, 999999);
                $user->profile_otp = $otp;
                $user->save();
                if(Auth::user()->email != ""){
                    
                    Mail::send('email.sendEmailOtp', ['user' => $otp], function ($message) use ($otp) {
                        $message->subject("OTP for Transaction Password");
                        $message->to(Auth::user()->email);
                    });
                }else{
                    return redirect('exchange');
                }
                // Mail::to($user->email)->send(new EmailVerification($user));
                    return view('passwords.transaction-password', ['email' => $user->email]);
            }
        } catch (\Exception $exception) {
            dd($exception);
        }
    }
    public function addTransactionPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'otp' => 'required',
                'password' => 'required'
            ]);
            if ($validator->fails()) {
                $firstError = $validator->errors()->first();
                return redirect('transaction-password')
                    ->with('error', $firstError)
                    ->withInput();
            }
            $user = Auth::user();
            $otp = $request->otp;
            $password = $request->password;
            if ($user->profile_otp == $otp) {
                if ($user->trans_password == "" || $user->trans_password == null) {
                    $user->trans_password = Hash::make($password);
                    $user->save();
                } else {
                    return redirect('exchange')->with('error', 'User Already Have Password');
                }
                return redirect('sellcrypto')->with('success', 'Transaction Password Set');

            } else {
                return redirect('exchange')->with('error', 'OTP Mismatch');
            }

        } catch (\Exception $e) {

        }
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
            'amount' => 'required|regex:/^[0-9]+$/',
        ],[
            'amount.required' => 'Amount field is required',
            'amount.regex' => 'Enter valid amount',
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
