<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\Bank;
use App\Models\UserWallet;
use App\Models\BuyTrades;
use App\Models\SellTrades;
use App\Models\CryptoTransactions;
use App\Models\CoinWithdraw;
use App\Models\CurrencyDeposit;
use App\Models\CurrencyWithdraw;
use App\Models\Kyc;
use App\Models\Commission;
use App\Models\Countries;
use App\Traits\AddressCreation;
use App\Mail\DepositEmail;
use App\Models\KycSubmit;
use App\Models\Withdrawaddress;
use App\Models\Deposit;
use App\Models\AdminAddress;
use App\Traits\GoogleAuthenticator;
use App\Exports\UserExport;
use App\Exports\BuyerExport;
use App\Models\UserLogin;
use App\Models\Category;
use App\Models\UserCommissionSettings;
use Illuminate\Support\Facades\Hash;
use App\Models\Trades;

use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    use AddressCreation, GoogleAuthenticator;

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $details = User::index();
        return view('user.users')->with('details', $details);

    }

    public function buyer()
    {
        $users = User::on('mysql2')->where(['user_type' => 'Buyer'])->orderBy('id', 'desc')->paginate(15);
        return view('user.buyer')->with('users', $users);
    }



    public function seller()
    {
        $users = User::on('mysql2')->where(['user_type' => 'Seller'])->orderBy('id', 'desc')->paginate(15);
        return view('user.seller')->with('users', $users);
    }

    public function addbuyer()
    {
        $Category = Category::get();
        return view('user.addbuyer',['category' => $Category]);
    }

    public function doaddBuyer(Request $request)
    {
        $this->validate($request, [

            'username' => 'required|max:50',
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],
            // 'role' => 'nullable|alpha_num|max:18',
            'role' => 'required|array',
            // 'role.*' => 'in:Base1,Base2,Base3',
            'price' => 'required|numeric',
            // 'phone_no' => 'required|alpha_num|min:10|max:15',

        ]);
        // $secret1 = $this->createSecret();
        $referal_id = $this->generateBarcodeNumber();

        $roles = $request->input('role');
        // dd($roles);
        $role = 'personal';
        $userRole = $request->role;
        $otp = rand(100000, 999999);
        $username = $request->username;
        $exits = User::where(['username' => $username])->first();
        if (!$exits) {

            $user = new User;
            $user->username = $request->username;
            $user->price = $request->price;
            // $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->user_type = 'Buyer';
            // $user->phone_no = $request->phone_no;
            $user->profile_otp = $otp;
            $user->role = $role;
            $user->user_role = $userRole;
            $user->user_role = implode(',', $roles);
            $user->referral_id = $referal_id;
            $user->email_verify = 1;
            $user->save();

            //send  email 
            return back()->with('success', 'Buyer Added');
        } else {
            return back()->with('error', 'UserName Already Taken');
        }
    }

    public function generateBarcodeNumber()
    {
        $number = 'WOLF' . mt_rand(100000000, 999999999);
        if ($this->codeNumberExists($number)) {
            return $this->generateBarcodeNumber();
        }
        return $number;
    }

    public function codeNumberExists($number)
    {
        return User::where('referral_id', $number)->exists();
    }

    public function export()
    {
        return Excel::download(new UserExport, 'UserData.xlsx');
    }

    public function buyerExport()
    {

        return Excel::download(new BuyerExport, 'BuyerData.xlsx');

    }

    public function edit($id)
    {
        $user_id = \Crypt::decrypt($id);
        if ($user_id) {

            $user = User::find($user_id);
            $Bank = Bank::where('uid', $user_id)->get();
            $Countries = Countries::get();
            $withdrawadres = Withdrawaddress::where('uid', $user_id)->get();
            $commission = Commission::where('type', '!=', 'fiat')->get();
            $uid = $id;
            $GWithdrawaddress = Withdrawaddress::where('uid', '=', $user_id)->get();
            if ($GWithdrawaddress->count()) {
                foreach ($GWithdrawaddress as $waddress) {
                    $Withdrawaddress[$waddress->currency]['address'] = $waddress->address;
                }
            } else {
                $Withdrawaddress = '';
            }
            $userroles = explode(',',$user->user_role);

            $Category = Category::get();
            
            return view('user.user_edit', ['userdetails' => $user, 'phone' => $user->phone_no, 'uid' => $uid, 'country' => $user->country, 'Bankuser' => $Bank, 'Countries' => $Countries, 'withdrawadres' => $withdrawadres, 'commission' => $commission, 'Withdrawaddress' => $Withdrawaddress, 'address' => $user->address,'userrole' => $userroles,'category' => $Category]);
        }
    }

    public function UsersReferral($id)
    {
        $user_id = \Crypt::decrypt($id);
        if ($user_id) {
            $user = User::find($user_id);
            $referral_id = User::where('id', $user_id)->value('referral_id');
            $userref = User::where('parent_id', $referral_id)->get();
            return view('user.user_referral', ['userdetails' => $user, 'userref' => $userref]);
        }
    }

    public function userkyc($id)
    {
        $user_id = \Crypt::decrypt($id);
        $user = User::find($user_id);
        $kyc = KycSubmit::on('mysql2')->where('uid', $user_id)->orderBy('id', 'desc')->paginate(10);
        return view('user.user_kyc', [
            'kyc' => $kyc,
            'userdetails' => $user,
            'uid' => $user_id
        ]);
    }

    public function user_buy_tradehistory($id)
    {
        $user_id = \Crypt::decrypt($id);
        $user = User::find($user_id);
        $buytrade = Trades::TradesHistory_user($user_id);
        return view('user.buytradehistory', ['userdetails' => $user, 'uid' => $user_id, 'buytrade' => $buytrade]);
    }


    public function user_sell_tradehistory($id)
    {
        $user_id = \Crypt::decrypt($id);
        $user = User::find($user_id);
        $selltrade = SellTrades::sellTradesHistory_user($user_id);
        return view('user.selltradehistory', ['userdetails' => $user, 'uid' => $user_id, 'selltrade' => $selltrade]);
    }


    public function userdeposit($id)
    {

        $user_id = \Crypt::decrypt($id);

        if ($user_id) {
            $depositList = CryptoTransactions::depsoitList_user($user_id);
            $user = User::find($user_id);
            $uid = $id;
            return view('user.user_deposit', ['userdetails' => $user, 'uid' => $uid, 'depositList' => $depositList]);
        }
    }


    public function userfiatdeposit($id)
    {

        $user_id = \Crypt::decrypt($id);
        if ($user_id) {
            $source = Commission::on('mysql2')->where('type', 'fiat')->value('source');

            $fiatdepositList = Deposit::on('mysql2')->where(['uid' => $user_id])->orderBy('id', 'desc')->paginate(10);
            $user = User::find($user_id);
            $uid = $id;
            return view('user.user_fiat_deposit', ['userdetails' => $user, 'uid' => $uid, 'deposit' => $fiatdepositList]);
        }
    }

    public function user_fiatdeposit_edit($id)
    {
        $depositList = CurrencyDeposit::edit(Crypt::decrypt($id));

        return view('user.deposit_edit')->with(['deposit' => $depositList]);
    }

    public function user_fiatdeposit_update(Request $request)
    {
        $depositUpdate = CurrencyDeposit::statusUpdate($request);

        return back()->with('success', 'Deposit Updated Successfully');
    }

    public function UserWithdrawList($id)
    {

        $user_id = \Crypt::decrypt($id);
        $user = User::find($user_id);
        $btcWithdraw = CoinWithdraw::on('mysql2')->where(['uid' => $user_id])->orderBy('id', 'desc')->paginate(15);
        return view('user.crypto_withdraw', ['userdetails' => $user, 'uid' => $user_id, 'transaction' => $btcWithdraw]);

    }


    public function WithdrawCryptoEdit($id)
    {
        $withdraw = CoinWithdraw::edit($id);
        //dd($withdraw);
        return view('user.cryptowithdraw_edit', [
            'withdraw' => $withdraw
        ]);
    }
    public function updateCryptoWithdraw(Request $request)
    {
        $withdraw = CoinWithdraw::withdrawUpdate($request);

        return back()->with('status', $withdraw);

    }



    public function user_fiat_withdraw($id)
    {
        $user_id = \Crypt::decrypt($id);

        $user = User::find($user_id);

        $crypto_trasnaction = CurrencyWithdraw::user_histroy_fiat($user_id);

        return view('user.fiat_withdraw', ['userdetails' => $user, 'uid' => $user_id, 'transaction' => $crypto_trasnaction]);

    }

    public function fiat_withdraw_edit($id)
    {
        $crypto_trasnaction = CurrencyWithdraw::edit(\Crypt::decrypt($id));

        return view('user.withdraw_edit', ['withdraw' => $crypto_trasnaction]);
    }

    public function fiat_withdraw_update(Request $request)
    {

        $crypto_trasnaction = CurrencyWithdraw::withdrawUpdate($request);

        return back()->with('status', 'Withdraw Updated Successfully');
    }



    public function update(Request $request)
    {

        $this->validate($request, [
            // 'email' => 'nullable|email|unique:users,email,' . $request->id . ',id',
            'country' => 'nullable',
            'phone' => 'nullable|min:8|max:15',
            'price' => 'numeric',
        ]);

        if ($request->emailcheck != "") {

            $twofactor = $request->twofactor;
            $user_id = $request->id;
            //Reset 2FA all
            if ($twofactor == 0) {
                $update = User::where('id', $user_id)->update(['twofa' => NULL, 'twofa_status' => 0]);
            }
            //Enable email OTP
            if ($twofactor == 1) {
                $update = User::where('id', $user_id)->update(['twofa' => 'email_otp', 'twofa_status' => 1]);
            }
            //Enable email OTP
            if ($twofactor == 3) {
                $update = User::where('id', $user_id)->update(['twofa' => 'google_otp', 'twofa_status' => 1]);
            }

            //Reset Google Autheticator
            if ($twofactor == 2) {
                $secret1 = $this->createSecret();
                $update = User::where('id', $user_id)->update(['twofa' => 'google_otp', 'twofa_status' => 1, 'google2fa_secret' => $secret1, 'google2fa_verify' => 0]);
            }


            $user = User::userUpdate($request);
            $userroleupdates = "";
            if(isset($request->user_role)){
                $userroleupdates = implode(',',$request->user_role);
            }
            
            
            $roleUpdate = User::where('id',$user_id)
            ->update([
                'user_role' => $userroleupdates,
            ]);

            \Session::flash('updated_status', 'Profile Details Updated Successfully.');


            return redirect()->back();
        } else {

            $user_id = $request->id;
            $crypt_id = \Crypt::encrypt($user_id);
            \Session::flash('updated_error', 'Fields required!.');
            return Redirect('admin/users_edit/' . $crypt_id);


        }

    }

    public function update_bank(Request $request)
    {

        // dd($request);
        $this->validate($request, [
            'bank_name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:50',
            'swift_code' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:50',
            'account_number' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:50',
            'bank_street' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:50',
            'bank_city' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:50',
            'bank_zip' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:50',
            'bank_country' => 'required',
        ]);

        $bank_details = Bank::where(['id' => $request->bankid])->first();
        $bank_details->bank_name = $request->bank_name;
        $bank_details->swift_code = $request->swift_code;
        $bank_details->account_number = $request->account_number;
        $bank_details->bank_street = $request->bank_street;
        $bank_details->branch_city = $request->bank_city;
        $bank_details->branch_zip = $request->bank_zip;
        $bank_details->country = $request->bank_country;
        $bank_details->save();

        \Session::flash('updated_status', 'Bank Details Updated Successfully.');

        $user_id = \Crypt::encrypt($request->uid);
        return Redirect('admin/users_edit/' . $user_id);



    }
    public function update_withdraw_address(Request $request)
    {

        $user = \Crypt::decrypt($request->userid);
        $commission = Commission::where('type', '!=', 'fiat')->get();



        foreach ($commission as $value) {

            $source = 'withdraw_address_' . $value->source;

            if ($request->$source == null || $request->$source == "") {
                $crypt_id = \Crypt::encrypt($user);
                \Session::flash('withdraw_error', 'Withdrawaddress required!');
                return Redirect('admin/users_edit/' . $crypt_id)->with('withdraw_error', 'Withdrawaddress required!');
            }

            $source = $value->source;
            $with_source = 'withdraw_address_' . $source;

            $withdraw = Withdrawaddress::where(['uid' => $user, 'currency' => $source])->first();

            if (!$withdraw || $withdraw == "") {
                $withdraw = new Withdrawaddress();
                $withdraw->uid = $user;
                $withdraw->currency = $source;
                $withdraw->address = $request->$with_source;
                $withdraw->status = 0;


            } else {
                $withdraw = Withdrawaddress::where(['uid' => $user, 'currency' => $source])->first();
                $withdraw->address = $request->$with_source;

            }
            $withdraw->save();
        }



        $crypt_id = \Crypt::encrypt($user);
        \Session::flash('withdraw_status', 'Withdraw address Updated Successfully!');
        return Redirect('admin/users_edit/' . $crypt_id)->with('withdraw_status', '   Withdraw address Updated Successfully!.');

    }


    public function userWallet($id)
    {
        $id = Crypt::decrypt($id);
        $wallet = UserWallet::userWalletDetails($id);
        $user = User::find($id);
        $currency = $wallet['balance'];
        $coins = $wallet['coin']->unique('source');
        $uid = Crypt::encrypt($id);
        $userswallet = UserWallet::where('uid', $id)->get();
        $Commission = Commission::select('source')->distinct('source')->get();

        return view('user.wallet', ['balance' => $currency, 'coins' => $coins, 'uid' => $uid, 'userdetails' => $user, 'userswallet' => $userswallet, 'Commission' => $Commission]);
    }


    public function Balance_update(Request $request)
    {

        $this->validate($request, [
            'coin' => 'required',
            'amount' => 'required|numeric',
            'remark' => 'nullable'
        ]);

        $coin = $request->coin;
        $balance = $request->amount;
        $uid = $request->uid;
        $remark = $request->remark;

        $type = Commission::where('source', $coin)->value('type');

        if ($type != 'fiat') {

            $fromaddress = UserWallet::where('uid', $uid)->where('currency', $coin)->value('mukavari');


            if (isset($fromaddress)) {
                try {
                    $txid = TransactionString();
                    $CryptoTransactions = new CryptoTransactions();
                    $CryptoTransactions->uid = $uid;
                    $CryptoTransactions->currency = $coin;
                    $CryptoTransactions->txtype = 'deposit';
                    $CryptoTransactions->txid = $txid;
                    $CryptoTransactions->from_addr = 'admindeposit';
                    $CryptoTransactions->to_addr = $fromaddress;
                    $CryptoTransactions->amount = $balance;
                    $CryptoTransactions->confirmation = 100;
                    $CryptoTransactions->status = 1;
                    $CryptoTransactions->nirvaki_nilai = 100;
                    $CryptoTransactions->remark = $remark;
                    $CryptoTransactions->save();
                    $insertid = $CryptoTransactions->id;


                    $wallet = UserWallet::on('mysql2')->where(['uid' => $uid, 'currency' => $coin])->first();

                    // if(is_object($wallet))
                    // {
                    //     $wallet->balance = ncAdd($wallet->balance,$balance);
                    //     $wallet->site_balance = ncAdd($wallet->balance,$balance);
                    //     $wallet->save();
                    // }
                    // else
                    // {
                    //     $bal = new UserWallet;
                    //     $bal->setConnection('mysql2');
                    //     $bal->uid            = $uid;
                    //     $bal->currency       = $coin;
                    //     $bal->escrow_balance = 0;
                    //     $bal->site_balance   = $balance;
                    //     $bal->balance        = $balance;
                    //     $bal->save();
                    // } 


                    UserWallet::creditAmount($uid, $coin, $balance, 8, 'deposit', $remark, $insertid);

                    $user = User::on('mysql2')->where('id', $uid)->first();
                    
                    
                    

                    $details = array(
                        'status' => 'Accept',
                        'coin' => $coin,
                        'amount' => $balance,
                        'user' => $user->name,

                    );

                    if($user->email != ""){
                        
                     \Mail::to($user->email)->send(new DepositEmail($details));
                        
                    }


                    return back()->with('status', 'Balance Updated Successfully');
                } catch (\Swift_TransportException $e) {
                    //dd($e);
                } catch (Exception $e) {
                    //dd($e);
                }
                return back()->with('status', 'Balance Updated Successfully');
            } else {
                return back()->with('error', 'Please create address!');
            }


        } elseif ($type == 'fiat') {
            try {
                $CurrencyDeposit = new CurrencyDeposit();
                $CurrencyDeposit->uid = $uid;
                $CurrencyDeposit->amount = $balance;
                $CurrencyDeposit->credit_amount = $balance;
                $CurrencyDeposit->proof = NULL;
                $CurrencyDeposit->currency = $coin;
                $CurrencyDeposit->status = 1;
                $CurrencyDeposit->remark = $remark;
                $CurrencyDeposit->save();
                $insertid = $CurrencyDeposit->id;


                $updateBal = UserWallet::where('uid', $uid)->where('currency', $coin)->first();
                UserWallet::creditAmount($uid, $coin, $balance, 8, 'deposit', $remark, $insertid);
                //dd($updateBal);

                // if(isset($updateBal->balance))
                // {
                // $updateBal->balance = ncAdd($updateBal->balance , $balance); 
                // $updateBal->site_balance = ncAdd($updateBal->site_balance , $balance); 
                // $updateBal->save();

                // }
                // else
                // {
                // $wallet = new UserWallet;
                // $wallet->uid = $uid;
                // $wallet->currency = $coin;
                // $wallet->balance = $balance;
                // $wallet->escrow_balance = 0;
                // $wallet->site_balance = $balance;
                // $wallet->save();

                // }               


                $user = User::on('mysql2')->where('id', $uid)->first();

                $details = array(
                    'status' => 'Accept',
                    'coin' => $coin,
                    'amount' => $balance,
                    'user' => $user->name
                );

                \Mail::to($user->email)->send(new DepositEmail($details));
            } catch (\Swift_TransportException $e) {
                //dd($e);
            } catch (Exception $e) {
                //dd($e);
            }
            return back()->with('status', 'Balance Updated Successfully');

        }
    }


    public function users_address($uid, $coin)
    {
        $id = Crypt::decrypt($uid);
        if ($coin == 'BTC')
            $btcAddress = $this->create_user_btc($id);
        elseif ($coin == 'LTC')
            $ltcAddress = $this->create_user_ltc($id);
        elseif ($coin == 'ETH')
            $ethAddress = $this->create_user_eth($id);
        \Session::flash('status', 'Address Created Successfully!.');
        return Redirect('admin/users_wallet/' . $uid);

    }



    public function usersearch(Request $request)
    {

        $q = $request->searchitem;
        $type = $request->type;
        $details = User::user_name_search($type, $q);
        if ($type == 'Buyer') {
            return view('user.buyer')->with('users', $details);
        } else {
            return view('user.seller')->with('users', $details);
        }
    }
    public function Adminwallet()
    {

        $result = AdminAddress::paginate(20);

        return view('user.adminwallet', ['result' => $result]);
    }
    public function Walletview($id)
    {

        $id = Crypt::decrypt($id);
        $result = AdminAddress::where('id', $id)->first();

        return view('user.adminwalletview', ['result' => $result]);
    }
    public function Walletupdate(Request $request)
    {
        $coinname = $request->coinname;
        $address = $request->address;
        $balance = $request->balance;
        $id = \Crypt::decrypt($request->id);

        AdminAddress::where(['id' => $id, 'asset' => $coinname])->update(['address' => $address]);

        return back()->with('status', 'Address Updated Successfully');
    }

    public function Transactionall($id, $coin = 'BTC')
    {
        $user_id = \Crypt::decrypt($id);
        if ($user_id) {
            $user = User::find($user_id);
            $Models = '\App\Models\OverallTransaction';
            $results = $Models::on('mysql3')->where(['uid' => $user_id, 'coin' => $coin])->paginate(20);
            $Commission = Commission::get();

            return view('user.user_transactions', ['userdetails' => $user, 'uid' => $user, 'results' => $results, 'Commission' => $Commission, 'coin' => $coin, 'id' => $id]);
        }
    }
    public function userLoginDetails()
    {
        $details = UserLogin::getAllDetails();
        return view('user.loginactivity')->with('details', $details);
    }

    public function loginActivitySearch(Request $request)
    {
        $q = $request->searchitem;
        $details = UserLogin::activitySearch(1, $q);
        return view('user.loginactivity')->with('details', $details);
    }


    public function currentLoginDetails()
    {
        $details = UserLogin::isLogged();
        return view('user.currentlogin')->with('details', $details);
    }

    public function Countrieslist()
    {

        $Countries = Countries::index();
        return view('Countries.Countrieslist', ['Countries' => $Countries]);

    }

    public function Countryedit($id)
    {
        $Country = Countries::edit($id);

        return view('Countries.Countriesedit', ['Country' => $Country]);


    }

    public function Countryupdate(Request $request)
    {

        $Country = Countries::where('id', $request->id)->first();


        $Country->code = $request->code;
        $Country->name = $request->name;
        $Country->status = $request->status;

        $Country->save();

        return redirect('/admin/countryedit/' . $Country->id)->with('status', 'Update sucessfully');

    }


    public function AddCountryForm()
    {

        return view('Countries.Addform');

    }

    public function StoreCountry(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'status' => 'nullable'

        ]);
        $Country = new Countries;

        $Country->code = $request->code;
        $Country->name = $request->name;

        $Country->status = $request->status;


        $Country->save();

        return redirect('/admin/countrieslist')->with('status', 'Added sucessfully');

    }

    public function DeleteCountry($id)
    {
        $Country = Countries::find($id);
        $Country->delete();

        return redirect('/admin/countrieslist')->with('status', 'Deleted Sucessfully');

    }

    public function user_commissions($id)
    {

        $id = Crypt::decrypt($id);
        $user = User::find($id);

        $data = UserCommissionSettings::where('uid', $id)->first();
        return view('user.user_commission', ['data' => $data, 'userdetails' => $user]);
    }

    public function updateusercommission(Request $request)
    {

        $data = UserCommissionSettings::where('uid', $request->id)->first();


        if (is_object($data)) {
            $data->trade_commission = $request->trade_commission;
            $data->swap_commission = $request->swap_commission;
            $data->withdraw_commission = $request->withdraw_commission;
            $data->save();
        } else {

            $result = new UserCommissionSettings();
            $result->uid = $request->id;
            $result->trade_commission = $request->trade_commission;
            $result->swap_commission = $request->swap_commission;
            $result->withdraw_commission = $request->withdraw_commission;
            $result->save();

        }

        return back()->with('updated_status', 'Updated Sucessfully');

    }
}
