<?php

namespace App\Http\Controllers;

use App\Models\WithdrawAddress;
use Exception;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Bankuser;
use Illuminate\Support\Facades\Validator;

use Auth;
use Illuminate\Support\Facades\Crypt;

class Withdrawcontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function withdraw(Request $request)
    {
        try {
            $user = Auth::id();
            $withdrawAddress = WithdrawAddress::where(['uid' => $user, 'last_select' => 1])->first();
            $userwallet = Wallet::where(['uid' => $user, 'currency' => 'USDT'])->first();
            return view('withdraw.withdraw', ['userwallet' => $userwallet, 'address' => $withdrawAddress]);
        } catch (\Exception $e) {
        }
    }

    public function addwithdrawaddress(Request $request)
    {
        return view('wallet.wallet-address');
    }

    public function dowithdrawAddress(Request $request)
    {
        try {
            $this->validate($request, [
                'address' => 'required|regex:/^T[a-zA-Z0-9]{33}$/',
            ]);
            $user = Auth::user();
            $address = $request->address;
            $count = WithdrawAddress::where(['uid' => $user->id, 'status' => 1, 'last_select' => 1])->count();
            $check = WithdrawAddress::where(['uid' => $user->id, 'address' => $address])->first();
            if ($check) {
                return Redirect('/add-address')->with('error', 'Address Already Have For this User');
            } else {
                $wa = new WithdrawAddress();
                $wa->uid = $user->id;
                $wa->address = $address;
                $wa->currency = "TRX";
                $wa->last_select = ($count == 0 ? 1 : 0);
                $wa->status = 1;
                $wa->save();
            }
            return redirect('withdraw');
        } catch (\Exception $e) {
        }
    }

    public function addreslist()
    {
        try {
            $user = Auth::user();
            $wallets = WithdrawAddress::where(['uid' => $user->id, 'status' => 1])->get();
            return view('wallet.wallet-address-inner', ['wallet' => $wallets]);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function setprimaryaddress(Request $request)
    {
        $accountID = $request->accountId;
        $user = Auth::user();
        $address = WithdrawAddress::where(['uid' => $user->id, 'status' => 1])->get();
        foreach ($address as $data) {
            $waddress = WithdrawAddress::where(['id' => $data->id])->first();
            if ($waddress->id == $accountID) {
                $waddress->last_select = 1;
            } else {
                $waddress->last_select = 0;
            }
            $waddress->save();
        }
        $url = 'withdraw';
        return response()->json(['success' => true, 'redirectPath' => $url]);
    }


}
