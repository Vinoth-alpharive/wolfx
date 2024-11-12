<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Storage;
use App\Models\Staking_information;
use App\Models\Staking_setting;
use App\Models\Staking_cancellation;
use App\Models\Commission;
use App\Models\Staking_user_deposit;
use App\Models\Staking_interest;
use App\Models\Stacking_wallet;
use App\Models\Stacking_withdraw;
use App\Models\Staking_terms;
use App\Models\UserWallet;
use App\Models\StakingOverAllStake;
use App\Models\Tradepair;
use App\Models\Staking_category;



class StakingController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }


    public function index()
    {
        
        $results = Staking_information::first();

        return view('staking.cms', ['results' => $results]);
    }

    public function updateInformation(Request $request)
    {

        $this->validate($request, [
                'title'              => 'required|max:50',
                'desc'             => 'required',
            ]);
        

        $fourm = Staking_information::where('id', $request->id)->first();
        $fourm->tittle  = str_replace("\r\n",'', $request->title);
        $fourm->desc  = str_replace("\r\n",'', $request->desc);
        $fourm->save();

        return back()->with('status','Updated Successfully!..');
        
    }


     public function Stackingcancellation()
    {
        
        $results = Staking_cancellation::first();

        return view('staking.cancellation_policy', ['results' => $results]);
    }

    public function updateCancellation(Request $request)
    {

        $this->validate($request, [
                'title'              => 'required|max:50',
                'desc'             => 'required',
            ]);
        

        $fourm = Staking_cancellation::where('id', $request->id)->first();
        $fourm->tittle  = str_replace("\r\n",'', $request->title);
        $fourm->desc  = str_replace("\r\n",'', $request->desc);
        $fourm->save();

        return back()->with('status','Updated Successfully!..');
        
    }

    public function Stackingview()
    {
        
        $Commission = Commission::where('status',1)->get();

        $details = Staking_setting::orderBy('id', 'desc')->paginate(15);
        return view('staking.list')->with(['details'=>$details,'Commission' => $Commission]);
    }


    public function StackAddview()
    {
        $commission = Commission::select('source')->where([['shown', '=', 1]])->groupBy('source')->orderBy('orderlist', 'asc')->get();
        $pairs      = Tradepair::where('active',1)->get();
        $category   = Staking_category::get();
        return view('staking.add')->with(['commission'=>$commission,'pairs'=>$pairs,'category'=>$category]);
    }

    public function Insertstack(Request $request)
    {   

           $this->validate($request, [
                'stacking_title'             => 'required|string',
                'deposit_coin'               => 'required',
                'min_amt'                    => 'required|numeric',
                'max_amt'                    => 'required|numeric',
                'duration_title'             => 'required',
               // 'penalty_type'             => 'nullable',
               // 'penalty_amount'             => 'nullable|numeric',
                'reward_type'                => 'required',
                'reward_token'               => 'required',
                'reward_interest'            => 'required|numeric',
                //'renewal'             => 'required',
                'staking_information'        => 'required',
                'cancellation_policy'        => 'required',
                'startdate'                  => 'required|date',
                'enddate'                    => 'required|date',
                'cancellation_controll'      => 'required|numeric',
                // 'rewards_credit_type'        => 'required|string',
                //'direct_interest'            => 'required|numeric',
                // 'category'                   => 'required|numeric',
                'stake_type'                 => 'required',
                'rewards_credit_type'        => 'required_if:stake_type,==,flexible', // Make reward required if stake_type is flexible
                'number_of_days'             => 'required_if:stake_type,==,locked',
                'summary_info'               => 'required',
                'termsaggrement'             => 'required',

            ]);

       /* $depositcheck = Staking_setting::where('deposit_coin',$request->deposit_coin)->first();

        if(!$depositcheck)
        {
*/
            $staking_information1 =$request->staking_information;
            $staking_information = str_replace("\r\n",'', $staking_information1);


            $terms_conditions1 =$request->cancellation_policy;
            $terms_conditions = str_replace("\r\n",'', $terms_conditions1);

            $duration_title = $request->duration_title.'months';
            // echo "<pre>";print_r($duration_title);exit;
            $insert = new Staking_setting();
            $insert->stacking_title    = $request->stacking_title;
            $insert->deposit_coin    = $request->deposit_coin;
            $insert->min_amt    = $request->min_amt;
            $insert->max_amt       = $request->max_amt;
            $insert->duration_title       = $duration_title;
            $insert->penalty_type       = $request->penalty_type;
            $insert->penalty_coin       = $request->deposit_coin;
            $insert->penalty_amount       = $request->penalty_amount;
            $insert->reward_type       = $request->reward_type;
            $insert->reward_token       = $request->reward_token;
            $insert->reward_interest       = $request->reward_interest;
           // $insert->renewal       = $request->renewal;
            $insert->staking_information       = $staking_information;
            $insert->terms_conditions       = $terms_conditions;
            $insert->startdate       = $request->startdate;
            $insert->enddate       = $request->enddate;
            $insert->cancellation_controll       = $request->cancellation_controll;
            $insert->rewards_credit_type       = isset($request->rewards_credit_type) ? $request->rewards_credit_type : null;
            $insert->direct_interest       = 0;
            // $insert->category       = $request->category;
            $insert->stake_type       = $request->stake_type;
            $insert->summary_info       = $request->summary_info;
            $insert->termsaggrement       = $request->termsaggrement;
            $insert->number_of_days       = isset($request->number_of_days) ? $request->number_of_days : 1;


            $insert->save();

            return redirect('/admin/stackingview')->with('status','Added Successfully!..');
        /*}
        else
        {
            return redirect('/admin/stackingview')->with('error','Already added this coin!..');
        }*/
    }



    public function stack_setting($id)
    {

        $id         = Crypt::decrypt($id);
        $details    = Staking_setting::where('id',$id)->first();
        
        $commission = Commission::select('source')->where([['shown', '=', 1]])->groupBy('source')->orderBy('orderlist', 'asc')->get();
        $pairs      = Tradepair::where('active',1)->get();
        $category   = Staking_category::get();
        


        return view('staking.edit')->with(['details'=>$details,'commission' => $commission,'pairs'=>$pairs,'category'=>$category]);
    }


    public function UpdateStack(Request $request)
    {   

// dd($request->termsaggrement);
        $this->validate($request, [
        'stacking_title'             => 'required|string',
        'deposit_coin'               => 'required',
        'min_amt'                    => 'required|numeric',
        'max_amt'                    => 'required|numeric',
        'duration_title'             => 'required|string',
        //'penalty_type'             => 'required',
       // 'penalty_amount'             => 'required|numeric',
        'reward_type'                => 'required',
        'reward_token'               => 'required',
        'reward_interest'            => 'required|string',
        //'renewal'             => 'required',
        'staking_information'        => 'required',
         'cancellation_policy'       => 'required',
        'startdate'                  => 'required|date',
        'enddate'                    => 'required|date',
        'cancellation_controll'      => 'required|numeric',
        // 'rewards_credit_type'        => 'required|string',
        //'direct_interest'            => 'required|numeric',
        // 'category'                   => 'required|numeric',
        'stake_type'                 => 'required',
        'rewards_credit_type'        => 'required_if:stake_type,==,flexible',
        'number_of_days'             => 'required_if:stake_type,==,locked',
        'summary_info'               => 'required',
        'termsaggrement'             => 'required',

        ]);

        $id = Crypt::decrypt($request->id);


            $staking_information1 =$request->staking_information;
            $staking_information = str_replace("\r\n",'', $staking_information1);


            $terms_conditions1 =$request->cancellation_policy;
            $terms_conditions = str_replace("\r\n",'', $terms_conditions1);

            $duration_title = $request->duration_title.'months';

            $update = Staking_setting::where('id',$id)->first();
            $update->stacking_title    = $request->stacking_title;
            $update->min_amt    = $request->min_amt;
            $update->max_amt       = $request->max_amt;
            $update->duration_title       = $duration_title;
            $update->penalty_type       = $request->penalty_type;
            $update->penalty_amount       = $request->penalty_amount;
            $update->reward_type       = $request->reward_type;
            $update->reward_token       = $request->reward_token;
            $update->reward_interest       = $request->reward_interest;
            //$update->renewal       = $request->renewal;
            $update->staking_information       = $staking_information;
            $update->terms_conditions       = $terms_conditions;
            $update->startdate       = $request->startdate;
            $update->enddate       = $request->enddate;
            $update->cancellation_controll       = $request->cancellation_controll;
            $update->rewards_credit_type       = isset($request->rewards_credit_type) ? $request->rewards_credit_type : null;
            $update->direct_interest       = 0;
            // $update->category       = $request->category;
            $update->deposit_coin       = $request->deposit_coin;
            $update->stake_type       = $request->stake_type;
            $update->summary_info       = $request->summary_info;
            $update->termsaggrement       = $request->termsaggrement;
            $update->number_of_days       = isset($request->number_of_days) ? $request->number_of_days : 1;

            $update->save();



            return redirect('/admin/stackingview')->with('status','Updated Successfully!..');
    }


    public function Stackremove($id)
    {

        $id = Crypt::decrypt($id);
        $details = Staking_setting::where('id',$id)->delete();
        
        return redirect('/admin/stackingview')->with('status','Deleted Successfully!..');
    }

    public function StackList(Request $request)
    {
       
        $list = Staking_user_deposit::orderBy('id', 'desc')->with('user')->paginate(10);
        
        $coinlist = Staking_user_deposit::select('deposit_coin')->distinct('deposit_coin')->get();  
        
        // echo "<pre>";print_r($list); exit;
        return view('staking.history',['list' => $list,'status' => 'all','coinlist' => $coinlist]);
    }

    public function Stack_status($status)
    {
        $list = Staking_user_deposit::where([['status', '=', $status]])->orderBy('id', 'desc')->paginate(10);
        
        $coinlist = Staking_user_deposit::select('deposit_coin')->distinct('deposit_coin')->get();

        return view('staking.history',['list' => $list,'status' => $status,'coinlist' => $coinlist]);
    }
    public function userrank(){
        $list = StakingOverAllStake::whereNotIn('role', ['Personal'])->whereNotNull('role')->paginate();
        return view('staking.rank',['list'=>$list]);
    }
     public function Stackview($id)
    {
        $id = Crypt::decrypt($id);
        $transaction = Staking_user_deposit::where('id', $id )->first();  
        return view('staking.invest_edit',['transaction' => $transaction]);
    }

    public function CancelStack($id) {

          $id = Crypt::decrypt($id);

            $stack   = Staking_user_deposit::where('id',$id)->whereIn('status', array(1, 4))->first();
            if($stack){

                $deposit_coin = $stack->deposit_coin;
                $amount = $stack->no_of_coin;
                $uid = $stack->uid;

                Stacking_wallet::creditAmount($uid,$deposit_coin,$amount,8,'Cancel stack','admin cancelled staking deposit', $id);

                $stack->status       = 3;
                $stack->cancel_date  = date("Y-m-d H:i:s",time());
                $stack->save();

                return redirect('admin/stacklist')->with('cancelsuccess', 'Stacking cancelled successfully!');

            }else{
                return redirect()->back()->withErrors('cancelerror', 'Already cancelled!');
            }
    }


     public function Rewardlist(Request $request)
    {
        $list = Staking_interest::orderBy('id', 'desc')->paginate(10);  
        return view('staking.reward_history',['list' => $list]);
    }
     public function RewardView($id)
    {
        $id = Crypt::decrypt($id);
        $list = Staking_interest::where('id',$id)->first();  
        return view('staking.reward_view',['transaction' => $list]);
    }


    public function RewardStakUpdate(Request $request)
    {
       
        $id = $request->id;
        $status = $request->status;
        $reward = Staking_interest::where('id', $request->id)->first();
      

        if($reward)
        {

            $uid =  $reward->uid;
            $coin =  $reward->coin;
            $amount =  $reward->amount;
            $stak_id =  $reward->stak_id;
            $interest_type =  $reward->interest_type;

            if($status == 1)
            {
                $status1 = 'approve'; 

                   $checkwallet = Stacking_wallet::where(['uid' => $uid,'currency' => $coin])->first();

                    if(!is_object($checkwallet))
                    {
                        $wallet = new Stacking_wallet();
                        $wallet->uid  = $uid;
                       // $wallet->stacking_id  = $stak_id;
                        //$wallet->interest_id  = $id;
                        $wallet->currency  = $coin;
                        //$wallet->interest_type  = $interest_type;
                        $wallet->balance  = $amount;
                        $wallet->save();
                    }
                    else{
                        $oldbalance = $checkwallet->balance;
                        $total = ncAdd($oldbalance, $amount, 8);
                        $checkwallet->balance = $total;
                        $checkwallet->updated_at = date('Y-m-d H:i:s',time());
                        $checkwallet->save();
                    }

                

            }
            elseif($status == 2)
            {
                $status1 = 'reject'; 
            } 

            else {
                $status1 = 'process'; 
            }

            $reward->status = $status;
            $reward->save();
            
        }


        return back()->with('status','Reward Updated Successfully');
    }



    public function Walletlist(Request $request)
    {
       $wallet = Stacking_wallet::orderBy('id', 'desc')->paginate(10);
        return view('staking.wallet',['wallet' => $wallet]);
    }


    public function Withdrawtrans(Request $request)
    {
       $withdraw = Stacking_withdraw::orderBy('id', 'desc')->paginate(10);
        return view('staking.withdraw',['withdraw' => $withdraw]);
    }

     public function WithdrawView($id)
    {
        $id = Crypt::decrypt($id);
       $withdraw = Stacking_withdraw::where('id', $id)->first();
        return view('staking.withdrawedit',['transaction' => $withdraw]);
    }


    public function WithdrawStakUpdate(Request $request)
    {
       
        $id = $request->id;
        $status = $request->status;
        $withdraw = Stacking_withdraw::where('id', $request->id)->first();
      // dd($withdraw);

        if($withdraw)
        {
            $stack_withdraw_amount = $withdraw->amount;
            $uid = $withdraw->uid;
            $coin = $withdraw->coin;

            if($status == 1)
            {
                $status1 = 'approve'; 
                //normal wallet
                $remark = 'Staking withdraw amount to wallet';
                UserWallet::creditAmount($uid,$coin,$stack_withdraw_amount,8,'stakingwithdraw',$remark, $id);


            }
            elseif($status == 2)
            {
                $debit = Stacking_wallet::where(['uid' => $uid,'currency' =>$coin ])->first();
                $total = ncAdd($debit->balance, $stack_withdraw_amount, 8);
                $debit->balance = $total;
                $debit->updated_at = date('Y-m-d H:i:s',time());
                $debit->save();
                $status1 = 'reject'; 
            } 

            else {
                $status1 = 'process'; 
            }

            $withdraw->status = $status;
            $withdraw->save();
            
        }


        return back()->with('status','Withdraw Updated Successfully');
    }


    public function Stackingterms()
    {
        
        $results = Staking_terms::first();

        return view('staking.terms', ['results' => $results]);
    }

    public function UpdateTerms(Request $request)
    {

        $this->validate($request, [
                'title'              => 'required|max:50',
                'desc'             => 'required',
            ]);
        

        $fourm = Staking_terms::where('id', $request->id)->first();
        $fourm->tittle  = str_replace("\r\n",'', $request->title);
        $fourm->desc  = str_replace("\r\n",'', $request->desc);
        $fourm->save();

        return back()->with('status','Updated Successfully!..');
        
    }


    public function Overallstake(Request $request)
    {

        $list = Staking_user_deposit::orderBy('id', 'desc')->paginate(10);
        return view('staking.overallstakelist',['list' => $list]);
    }

    public function StakeCategory(Request $request){

        $data = Staking_category::paginate(10);
        return view('staking.stakecategory',['data'=>$data]);
    }

    public function addstakecategory(Request $request){

        return view('staking.addstakecategory');
    }

    public function Storestakecategory(Request $request){

        $request->validate([
            'stake_category' => 'required',
        ]);

        $stakecategory           = new Staking_category();
        $stakecategory->category = $request->stake_category;
        $stakecategory->save();
        return back()->with('status','Added Successfully!');
    }

    public function Stakecategoryedit($id) {

        $id   = Crypt::decrypt($id);   
        $data = Staking_category::find($id);

        return view('staking.editstakecategory',['data' => $data]);

    }

    public function Stakecategoryupdate(Request $request) {

        $request->validate([
            'stake_category' => 'required',
        ]);
        $id             = Crypt::decrypt($request->id);   
        $data           = Staking_category::where('id',$id)->first();
        $data->category = $request->stake_category;
        $data->save();

        return back()->with('status','Updated Successfully!');

    }


    public function Stakecategorydelete($id) {

        $id      = Crypt::decrypt($id);
        $details = Staking_category::where('id',$id)->delete();

        return back()->with('status','Deleted Successfully!');

    }

    public function Stakeduplicate($id) {

        $id = Crypt::decrypt($id);

        $stack = Staking_setting::find($id);
        $newstack = $stack->replicate();
        $newstack->stacking_title = $newstack->stacking_title.'copy';
        $newstack->save();

        $Commission = Commission::where('status',1)->get();

        $details = Staking_setting::orderBy('id', 'desc')->paginate(15);
        return back()->with('status','Duplicated Successfully!');
    }
    
}
