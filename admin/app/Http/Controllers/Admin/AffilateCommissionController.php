<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AffilateCommission;
use App\Models\Commission;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Affilate_CommissionRequest;

class AffilateCommissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        
        $commission = AffilateCommission::index();

        return view('affliate_commission.commission',[
                'commissions' => $commission
            ]);
    }
    public function add(){
        $commission =Commission::where('shown',1)->get();
        return view('affliate_commission.add')->with(['commission'=>$commission]);
    }
    public function store(Request $request){
       $request->validate([

        'generation' =>'required',
        'coin_name'=>'required',
        'register' =>'nullable',
        'stake' =>'required',
        'title' =>'required',
      ]);
      $aff = new  AffilateCommission();
       
      $aff->coin =$request->coin_name;
      $aff->generation =$request->generation;
      $aff->stake =$request->stake;
      $aff->register =$request->register ? $request->register : 0;
      $aff->trade =$request->trade ? $request->trade : 0;
      $aff->title =$request->title;

      $aff->save();
      return back()->with('status',' Added Successfully');
      
    }

    public function edit($id)
    {
        $AffilateCommission = AffilateCommission::edit(Crypt::decrypt($id));
        $commission = Commission::index();
        
        return view('affliate_commission.edit')->with(['commission' => $commission,'AffilateCommission' => $AffilateCommission]);


    }

    public function commissionUpdate(Request $request)
    {
      $request->validate([

        'generation' =>'required',
        'coin_name'=>'required',
        'register' =>'nullable',
        'stake' =>'required',
        'title' =>'required',
      ]);
      $commission = AffilateCommission::where('id',$request->id)->first();
      $commission->coin =$request->coin_name;
      $commission->generation =$request->generation;
      $commission->stake =$request->stake;
      $commission->register =$request->register ? $request->register : 0;
      $commission->trade =$request->trade ? $request->trade : 0;
      $commission->title =$request->title;
      $commission->save();

      return back()->with('status','Commission Updated Successfully');
    }



}
