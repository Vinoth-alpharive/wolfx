<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\AffliateTransaction;
use App\Models\PurchaseHistory;
use App\Models\Cryptotransaction;
use App\Models\Coinwithdraw;
use App\Models\Bankuser;
use App\Models\AffilateCommission;
use App\Models\Trade;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Auth;
use Exception;
use Illuminate\Support\Facades\Validator;

class Profilecontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::id();
        $walletbalance = Wallet::where('uid', $user)->sum('balance');
        $availablewalletbalance = Wallet::where('uid', $user)->sum('site_balance');
        $availableescrowbalance = Wallet::where('uid', $user)->sum('escrow_balance');
        $total_rewards = AffliateTransaction::where('uid', $user)->sum('price');
        $total = $availablewalletbalance + $availableescrowbalance;
        return view('layouts.profile', (['balance' => $walletbalance, 'totalbalance' => $total, 'availablebalance' => $availablewalletbalance, 'total_rewards' => $total_rewards, 'process' => $availableescrowbalance]));
    }

    public function Referralreward(Request $request)
    {
        $user = Auth::id();
        $total_rewards = AffliateTransaction::where('uid', $user)->select('created_at', 'price')->get();
        $total_rewards_count = count($total_rewards);
        return view('referral.referral-rewards', (['total_rewards' => $total_rewards, 'total_rewards_count' => $total_rewards_count]));
    }

    public function Exchangehistorydeposit(Request $request)
    {
        $user = Auth::id();
        $all_history = Cryptotransaction::where('uid', $user)->get();
        return view('exchange.deposithistory', (['all_history' => $all_history]));
    }

    public function Exchangehistorywithdraw(Request $request)
    {
        $user = Auth::id();
        $all_history = Coinwithdraw::where('uid', $user)->get();
        return view('exchange.withdrawhistory', (['all_history' => $all_history]));
    }

    public function Statement(Request $request)
    {
        $user = Auth::id();
        $all_history = Trade::where('uid', $user)->get();
        return view('exchange.statement', (['all_history' => $all_history]));
    }

    public function Invitefriendsreferral(Request $request)
    {
        $user = Auth::id();
        $all_commission = AffilateCommission::orderby('generation', 'asc')->get();
        $referral = User::where('id', $user)->select('referral_id')->first();
        return view('invite.invite-friends', (['all_commission' => $all_commission, 'referral' => $referral]));
    }

    public function Resetpassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8',
            'password_confirmation' => 'required|min:8',
        ]);

        $user = Auth::user();

        $current_password = $request->oldpassword;
        $new_password = $request->newpassword;
        $confirm_password = $request->password_confirmation;
        $input_password = $user->password;

        if (crypt($current_password, $input_password) == $input_password) {

            if ($new_password == $confirm_password) {
                $password = bcrypt($new_password);

                $update = User::where('id', '=', $user->id)->update(['password' => $password]);
                if ($update) {

                    $password_success_response = 'Password Changed Successfully!';
                    return Redirect::back()->with(['status' => $password_success_response]);
                } else {

                    $password_failed_response = 'Password Not Updated!';
                    return Redirect::back()->with(['status' => $password_failed_response]);
                }
            } else {

                $password_failed_response = 'Password length should be minimum 8!';
                return Redirect::back()->with(['status' => $password_failed_response]);
            }
        } else {

            $password_failed_response = 'You entered wrong current password!';
            return Redirect::back()->with(['status' => $password_failed_response]);
        }
    }

    public function addbank()
    {
        return view('exchange.addbank');
    }

    public function doaddBank(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'acc_no' => 'required',
                'ifsc' => 'required',
                'acc_name' => 'required',
            ]);
            if ($validator->fails()) {
                $firstError = $validator->errors()->first();
                return redirect('add-bank')
                    ->with('error', $firstError)
                    ->withInput();
            }
            $user = Auth::user();
            $check = Bankuser::where(['uid' => $user->id, 'status' => 1])->count();
            if ($check > 5) {
                return Redirect('add-bank')->with('error', "you can't Add More Than 5 Accounts");
            } else {

                $bank = new Bankuser();
                $bank->uid = $user->id;
                $bank->account_name = $request->acc_name;
                $bank->account_no = $request->acc_no;
                $bank->swift_code = $request->ifsc;
                $bank->is_primary = ($check == 0 ? 1 : 0);
                $bank->status = 1;
                $bank->save();
            }
            return redirect('add-bank')->with('success', "Added Successfully");
        } catch (\Exception $e) {
        }
    }

    public function bankList()
    {
        try {
            $user = Auth::user();
            $bank = Bankuser::where(['uid' => $user->id, 'status' => 1])->get();
            return view('exchange.banklist', ['bank' => $bank]);
        } catch (Exception $exception) {
        }
    }

    public function setprimaryAccount(Request $request)
    {
        $accountID = $request->accountId;
        $user = Auth::user();
        $bank = Bankuser::where(['uid' => $user->id, 'status' => 1])->get();
        foreach ($bank as $data) {

            $cbank = Bankuser::where(['id' => $data->id])->first();
            if ($cbank->id == $accountID) {
                $cbank->is_primary = 1;
            } else {
                $cbank->is_primary = 0;
            }
            $cbank->save();
        }
        $url = 'sellcrypto';
        return response()->json(['success' => true, 'redirectPath' => $url]);
    }




}
