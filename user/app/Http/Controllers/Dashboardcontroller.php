<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\Tradepair;
use Auth;

class Dashboardcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        
        $keynote = GeneralSetting::where(['key' => 'feature', 'status' => 0])->get();
        $advantages = GeneralSetting::where(['key' => 'platform', 'status' => 0])->get();
        $trades = Tradepair::get();
        $tabsTrades = Tradepair::where('coinone', '!=', 'USDT')->take(2)->get();
        $tabsTrending = Tradepair::where('coinone', '!=', 'USDT')->orderBy('orderlist', 'Asc')->take(2)->get();
        return view('home.home', (['keynote' => $keynote, 'tabsTrades' => $tabsTrades, 'trades' => $trades, 'advantages' => $advantages, 'tabsTrending' => $tabsTrending]));

    }
    public function form_referral(Request $request)
    {
        $validator = $this->validate($request, [
            'referral_code' => 'required|max:18',
        ]);

        $referral_code = $request->referral_code;
        if ($referral_code != "") {
            $User = User::where('referral_id', $referral_code)->value('first_name');
            if ($User) {
                $var = \Response::json(array(
                    'status' => true,
                    'res' => $User
                ));
            } else {
                $var = \Response::json(array(
                    'status' => false,
                    'res' => 'Invalid referral code'
                ));
            }
        } else {
            $var = \Response::json(array(
                'status' => false,
                'res' => 'Invalid referral code'
            ));
        }
        return $var;
    }
}
