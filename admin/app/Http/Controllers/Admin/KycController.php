<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kyc;
use App\User;
use App\Models\KycSubmit;
use App\Models\UserWallet;
use App\Models\AffilateCommission;
use Illuminate\Support\Facades\Crypt;
use App\Mail\AdminAcceptKyc;
use App\Mail\AdminRejectKyc;
use App\Models\Coinuser;
use Mail;
use App\Models\UserBankDetail;
use App\Models\Bank;
use App\Models\UserKyc;
use App\Models\UserWithdrawAddressDetail;
use App\Models\Withdrawaddress;
use App\Models\AffliateTransaction;
use App\Traits\AddressCreation;
use App\AdminsUser;

class KycController extends Controller
{
  use AddressCreation;
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){        
        $kyc = KycSubmit::index();

        return view('user.kyc',['kyc' => $kyc]);
    }

    public function kycview($id){

          $kyc = KycSubmit::edit(Crypt::decrypt($id));
         $Bank =Bank::where('uid',$kyc->uid)->first();
         $withdrawadres =Withdrawaddress::where('uid',$kyc->uid)->get();

        return view('user.kyc_edit',['kyc' => $kyc,'Bankuser' => $Bank ,'withdrawadres' => $withdrawadres]);
    }

    public function kycUpdate(Request $request)
    {

        
        $status = $request->status;
        $thisUser=Coinuser::find($request->uid);
         
        if($status == 1){
          $this->EmailAcceptKYC($thisUser);
          $userkyc =KycSubmit::where('id',$request->kyc_id)->first();
          if(isset($userkyc))
          {
            AdminsUser::updateadmin($thisUser);
            AdminsUser::updateUserkyc($userkyc);
            AffliateTransaction::affliate_transaction($request->uid,0,'register');
          }


          $user_referal = User::where('id',$userkyc->uid)->select('parent_id','id')->first();
          
          $user_referal_parent = User::where('referral_id',$user_referal->parent_id)->select('id')->first();

          
          if($user_referal->parent_id != ""){
            
            
            $commission_payable = AffilateCommission::where('type','register')->select('amount','coin')->first();
            
            if($commission_payable->amount != 0 && $commission_payable->amount != ""){

            
            $affiliate_transaction = AffliateTransaction::insertGetId([
                'uid' => $user_referal_parent->id,
                'from_id' => $user_referal->id,
                'coin' => $commission_payable->coin,
                'type' => 'Register',
                'reason' => 'Register Referral',
                'quantity' => null,
                'price' => null,
                'commission' => $commission_payable->amount,
            ]);
            // dd($user_referal_parent->id,$commission_payable->coin,$commission_payable->amount,$affiliate_transaction);
            $user_wallets = UserWallet::creditAmount($user_referal_parent->id,$commission_payable->coin,$commission_payable->amount,8,'Register','Register Referral',$affiliate_transaction);
            
            }
            
            
          }
         

        }
        else if($status == 2)
        {
          $this->EmailRejectKYC($thisUser,$request);
        }
       $kyc = KycSubmit::updateKyc($request);
        return back()->with('status','Kyc Updated Successfully');
    }

    public function EmailAcceptKYC($thisUser)
    {
      try {
       Mail::to($thisUser['email'])->send(new AdminAcceptKyc($thisUser));
     } catch (Exception $e){
       dd($e);
     } catch (\Swift_TransportException $e){
      //dd($e);
    }
    }

    public function EmailRejectKYC($thisUser,$request)
    {
      try {
       Mail::to($thisUser['email'])->send(new AdminRejectKyc($thisUser,$request));
     } catch (Exception $e){
       dd($e);
     } catch (\Swift_TransportException $e){
      //dd($e);
    }
    }
}
