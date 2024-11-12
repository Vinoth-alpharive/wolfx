<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Models\Supportchat;
use App\Models\Tickets;
use App\Models\CoinWithdraw;


class User extends Model
{

    protected $connection = 'mysql2';
    protected $table = 'users';

    protected $fillable = ['id', 'role', 'username', 'email', 'email_verified_at', 'phone_country', 'password', 'phone_no', 'phone_verified', 'country', 'nationality', 'dob', 'profileimg', 'address', 'twofa', 'twofa_status', 'google2fa_secret', 'google2fa_verify', 'email_verify', 'kyc_verify', 'profile_otp', 'referral_id'];


    public static function dashboard()
    {
        $totalusers = User::on('mysql2')->count();
        $buyer = User::where(['user_type' => 'Buyer'])->count();
        $seller = User::where(['user_type' => 'Seller'])->count();
        $kycverify = User::on('mysql2')->where('kyc_verify', '=', 1)->count();
        $chat = Supportchat::on('mysql2')->where('admin_status', '=', 0)->count();
        $withdraw_request = CoinWithdraw::on('mysql2')->where('status', '=', 0)->where('coin_name', '!=', 'USD')->orderBy('id', 'desc')->limit(10)->get();
        $support_ticket = Tickets::on('mysql2')->orderBy('id', 'desc')->limit(10)->get();
        $details = array(
            'totalusers' => $totalusers,
            'chat' => $chat,
            'buyer' => $buyer,
            'seller' => $seller,
            'withdraw_request' => $withdraw_request,
            'support_ticket' => $support_ticket,
        );
        return $details;
    }

    public static function index()
    {
        $users = User::on('mysql2')->orderBy('id', 'desc')->paginate(15);
        return $users;
    }

    public static function find($id)
    {
        $user = User::where('id', '=', $id)->first();

        return $user;
    }

    public static function userUpdate($request)
    {
        //dd($request);
        $username = $request->username;
        $email = $request->email;
        $country = $request->country;
        $phone = $request->phone;
        $address = $request->address;
        $user_id = $request->id;
        $dob = $request->dob;
        $price = $request->price;
        $emailcheck = $request->emailcheck;
        $mobile_verify = $request->phone_verified ? $request->phone_verified : 0;
        $status = $request->status;
        $freeze = $request->freeze ? $request->freeze : 0;
        $remarks = $request->remarks;
        $email = $request->email;
        $referral_id = $request->referral_id;
        $parent_id = $request->parent_id;
        $nationality = $request->nationality;
        if (isset($request->user_status)) {
            $user_status = $request->user_status;
        } else {
            $user_status = 0;
        }
        if (isset($request->reason_block)) {
            $reason_block = $request->reason_block;
        } else {
            $reason_block = '';
        }
        //$update = User::where('id', $user_id)->update(['name' => $fname, 'email' => $email, 'phone_no' => $phone, 'country' => $country, 'address' => $address ,'email_verify' => $emailcheck,'status' => $user_status,'reason' => $reason_block]);
        $update = User::where('id', $user_id)->update([

            'phone_no' => $phone,
            'country' => $country,
            'address' => $address,
            'dob' => $dob,
            'nationality' => $nationality,
            'status' => $user_status,
            'price' => $price,
            'freeze' => $freeze,
            'email_verify' => $emailcheck,
            'phone_verified' => $mobile_verify,
            'email' => $email,
            'referral_id' => $referral_id,
            'parent_id' => $parent_id,
            'reason' => $remarks
        ]);

        $user = User::where('id', '=', $user_id)->first();
        $crypt_id = Crypt::encrypt($user_id);
    }

    public static function userWalletDetails($id)
    {
        $btcAddress = '';
        $ethAddress = '';
        $xrpAddress = '';

        $details = array(
            'BTC' => $btcAddress,
            'ETH' => $ethAddress,
            'XRP' => $xrpAddress,
        );

        return $details;

    }
    public static function user_name_search($type, $q)
    {

        $result = User::where(function ($query) use ($q, $type) {
            $query->where('user_type', $type);
            $query->where('username', 'LIKE', '%' . $q . '%');
            $query->orWhere('email', 'LIKE', '%' . $q . '%');
        })->orWhereRaw("concat(first_name, ' ',last_name) like '%" . $q . "%'")
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        if (empty($result)) {
            $result = User::whereRaw("concat(first_name, ' ', last_name) like '%?%'", [$q])
                ->orWhereRaw("concat(last_name, ' ', first_name) like '%?%'", [$q])
                ->orderBy('updated_at', 'desc')
                ->paginate(15);
        }

        return $result;
    }
    public static function user_kyc_search($status, $q)
    {

        $result = Kyc::on('mysql2')->where(function ($query) use ($q) {
            $query->where('first_name', 'LIKE', '%' . $q . '%');
            $query->orWhere('last_name', 'LIKE', '%' . $q . '%');
            $query->orWhere('email', 'LIKE', '%' . $q . '%');
        })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return $result;

    }

}