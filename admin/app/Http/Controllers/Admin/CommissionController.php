<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Liveprice;
use App\User;
use Validator;
use App\Models\CommissionHistory;
use App\Models\AffilateCommission;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\CommissionRequest;
use App\Http\Requests\CoincommissionRequest;


class CommissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $commission = Commission::index();
        return view('commission.commission',[
                'commissions' => $commission
            ]);
    }
    public function addtoken(Request $request)
    {
        return view('commission.add');
    }
    public function addtokeninsert(CoincommissionRequest $request)
    {
        /*if(isset($request->image)){
            $pho = $request->image;
            $filenamewithextension = $pho->getClientOriginalName();
            $photnam = strtolower($request->symbol);
            $filename = pathinfo($photnam, PATHINFO_FILENAME);
            $extension = $pho->getClientOriginalExtension();
            $photo = $filename . '.' . $extension;
            Storage::disk('ftp')->put($photo, fopen($request->file('image'), 'r+'));
        }else{
            return back()->with('error','Token Image Mandatory! please upload');
        }*/

        $is_exits = Commission::where(['source' => $request->symbol])->first();
        if($is_exits){
            return back()->with('error','Token already exists!');
        }
        $commission = new Commission();
        $commission->source        = $request->symbol;
        $commission->coin_name = $request->coinname; 
        $commission->withdraw  = $request->withdraw;
        $commission->type = $request->type;
        $commission->point_value = $request->digit;
        $commission->netfee = $request->netfee;
        $commission->contractaddress = $request->contractaddress;
        $commission->abiarray = $request->abiarray;
        $commission->min_deposit = $request->min_deposit;
        $commission->min_withdraw = $request->min_withdraw;
        $commission->shown = 1;
        $commission->url = $request->url;
        $commission->is_swap =$request->is_swap;
        //$commission->image = $photo ? $photo : '';
        $commission->save();


           // User::update('is_address', 0);
        User::where(['email_verify' => 1])->update(['is_address' => 0, 'updated_at' => date('Y-m-d H:i:s',time())]);
     

        return back()->with('status','Token Added Successfully');
    }

    public function edit($id)
    {
        $commission = Commission::edit(Crypt::decrypt($id));
        return view('commission.edit')->with(['commission' => $commission]);
    }

    public function commissionUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'issue_date' => 'date_format:Y-m-d',
        ], [
            
            'issue_date.date_format' => 'The issue date must be in the format YYYY-MM-DD.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->validate($request, [               
            'id' => 'required|numeric',            
            'currency' => 'required',            
            'withdraw' => 'required', 
            'min_withdraw' => 'required',  
            'perday_withdraw' =>'required',
            'min_deposit' => 'required',                    
            'com_type' => 'required',                    
        ]);
        
        $commission = Commission::commissionUpdate($request);

        return back()->with('status','Commission Updated Successfully');
    }


    public function commissionhistory($pair)
    {

        $commission = CommissionHistory::index($pair);
        $comm_sum = CommissionHistory::addsum($pair);
        $pairs = Commission::orderBy('id', 'asc')->get();

        return view('commission.commissionhistory',[
                'commissions' => $commission,'comm_sum' => $comm_sum,'pairdetails' => $pair,'pairs' => $pairs
            ]);
    }



//commissionhistory


public function Referalcommission(Request $request){

    $commission = AffilateCommission::on('mysql2')->paginate(15);

    return view('commission.referealcommission',(['commissionReferal' => $commission]));

}

public function Editreferalcommission(Request $request,$id){


    $id = Crypt::decrypt($id);

    $commissions = AffilateCommission::on('mysql2')->where('id',$id)->first();

    $coins = Commission::select('source')->where('shown',1)->distinct('source')->get();
    
    return view('commission.editreferralcommission',(['commission' => $commissions,'coins' => $coins]));

}

public function Updatereferalcommission(Request $request){
    
    $request->validate([
        'coin' => 'required',
        'amount' => 'required',
        'reward_type' => 'required',
        'referral_description' => 'required'

    ]);


    $commissions = AffilateCommission::on('mysql2')->where('id',$request->id)->update([
        'coin' => $request->coin,
        // 'role' => $request->role,
        // 'generation' => $request->generation,
        // 'deposit' => $request->deposit,
        // 'register' => $request->register,
        // 'stake' => $request->stake,
        // 'trade' => $request->trade,
        'amount' => $request->amount,
        // 'type' => $request->type,
        // 'title' => $request->title,
        'reward_type' => $request->reward_type,
        'referral_description' => $request->referral_description,
    ]);

    return back()->with('status','Referal Commission Updated Successfully');

}
   

}
