<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Session;
use App\Models\User;
use App\Models\Security;
use App\Models\Admin;
use App\Models\Mobile_security;
use App\Models\Adminwallet;
use App\Models\AdminTransactions;


class DashboardController extends Controller
{

	public function __construct()
    {
        $this->middleware('admin');
    }


    public function index()
    {
    	$dashboard = User::dashboard();

    	return view('dashboard')->with('details',$dashboard);
    }


    public function security()
    {   
        $Admin  = Admin::value('email');

    	return view('settings.security',['adminemail' => $Admin ]);
    }
    public function mobile_security()
    {

         $Mobile_security= Mobile_security::first();
        return view('settings.mobilesecurity',['Mobile_security' => $Mobile_security]);
    }

     public function update_security(Request $request)
    {

        $rules = [
          'kyc_sec' => 'required'
        ];
        
        $messages = [
            'kyc_sec.required' => 'Field is required.'
        ];  
        
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()
            ->withInput()
            ->withErrors($validator);
        }  

        $kyc_sec  =  $request->kyc_sec;


        $Mobile_security= Mobile_security::first();

        if(!$Mobile_security)
        {
            $Mobile_security = new Mobile_security();
           
        }
         $Mobile_security->kyc = $kyc_sec;
         $Mobile_security->updated_at = date('Y-m-d H:i:s',time());
         $Mobile_security->save();


        return back()->with('success','Updated Successfully!');
    }


    public function updateUsername(Request $request)
    {

        $rules = [
         'email' => 'email|required'
        ];

        $messages = [
        'email.required' => 'Field is required.'
        ];  

        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
        return back()
        ->withInput()
        ->withErrors($validator);
        }  


        $update = Admin::updateUsername($request);

        return back()->with('status',$update);
    }

    public function changepassword(Request $request)
    {
        $update = Admin::changepassword($request);

        return back()->with('status',$update);
    }

    public function feescollected(Request $request){
        
        $data = Adminwallet::paginate(10);

        return view('feescollected',["data"=>$data]);
    }

    public function transactionhistory(Request $request){

        $data = AdminTransactions::paginate(10);
        return view('adminfeestransaction',["data"=>$data]);

    }
}
