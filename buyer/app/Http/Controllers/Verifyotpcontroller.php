<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Crypt;

class Verifyotpcontroller extends Controller
{
    public function VerifyOtp(Request $request){
        $this->validate($request, [
            'verificationcode' => 'required|numeric',
            'useremail' => 'required|string|email'
        ]);
        
        $check = User::where(['email' => $request->useremail,'profile_otp' => $request->verificationcode])->first();

        if(is_object($check)){

            User::where(['email' => $request->useremail])->update(['email_verify'=> 1,'email_verified_at' => date('Y-m-d H:i:s',time())]);

            \Session::flash('status', 'Your mail ID is now verified and account activated.Please sign in to get started');
            
            Auth::logout();
            
            return redirect('login');
        }else{
            return back()->with('error','Enter valid Otp');
        }

    }

    public function otpindex($email){

        Auth::logout();

        $email = Crypt::decryptString($email);

        return view('security.verify-code',(['email' => $email]));

    }
    public function otpform(){

        Auth::logout();

        $email =  \Session::get('successemail');

        return view('security.verify-code',(['email' => $email]));

    }
}
