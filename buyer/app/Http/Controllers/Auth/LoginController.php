<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use Mail;
use Session;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/exchange';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function authenticated($request, $user)
    {

        if ($user->user_type == "Buyer") {

            $ip = $request->getClientIp();
            $ip1 = $_SERVER['REMOTE_ADDR'];
            $details = json_decode(crul("http://ipinfo.io/{$ip1}/json"));
            if (isset($details->country)) {
                $location = $details->city . ', ' . $details->region . ', ' . $details->country;
            } else {
                $location = "";
            }

            //User login
            $UserLogin = UserLogin::where(['user_id' => \Auth::id(), 'login_ip' => $ip])->first();
            if ($UserLogin) {
                $UserLogin->status = 1;
                $UserLogin->save();
            } else {
                $data = array();
                $data['user_id'] = \Auth::id();
                $data['login_ip'] = $ip;
                $data['device'] = "PC";
                $data['location'] = $location;
                $data['status'] = 1;
                UserLogin::attemptSave($data);
            }

            $random = rand();
            $otp = substr($random, 0, 6);
            $userupdate = User::where('id', \Auth::id())->first();
            $userupdate->ipaddr = $ip;
            $userupdate->location = $location;
            $userupdate->profile_otp = $otp;
            $userupdate->save();
            $check = User::where('username', $request->username)->first();

            if ($check) {
                return redirect('/exchange');
            } else {
                \Session::flash('error', 'Invalid username id, please check your username');
                return back();
            }
        } else {
            auth()->logout();
            return back()->with('status', 'Invalid User');
        }
    }

    public function sendEmail($thisUser)
    {
        try {
            Mail::send('email.sendEmailOtp', ['user' => $thisUser], function ($message) use ($thisUser) {
                $message->from('wolfx.vip@gmail.com', 'Wolfx');
                $message->subject("Verification Code");
                $message->to($thisUser['email']);
            });
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function logout(Request $request)
    {
        //User
        $user = Auth::user();
        if($user){
        $user->is_logged = 0;
        $user->updated_at = date('Y-m-d H:i:s', time());
        $user->save();
        $userapi = UserLogin::where('user_id', $user->id)->first();
        if ($userapi) {
            $userapi->status = 0;
            $userapi->save();
        }
        Session::flush();
        Auth::logout();
        }
        return redirect('/login');
    }
    protected function validateLogin(Request $request)
    {
        // dd($request);
        // $niceNames = array(
        //     'g-recaptcha-response' => 'ReCaptcha ',
        // );
        $this->validate($request, [
            'username' => 'required|string|max:120',
            'password' => 'required|string',
            // 'g-recaptcha-response' => 'required|captcha',
        ], []);

    }
}