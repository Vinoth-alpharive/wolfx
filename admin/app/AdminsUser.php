<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserKyc;
class AdminsUser extends Model
{
    protected $connection = 'mysql';
    protected $table = 'users';

    public static function updateadmin($user)
    {
        $adminback = AdminsUser::where('id',$user->id)->first();
        if(!$adminback){
           $adminback = new AdminsUser;
           $adminback->id = $user->id;
        }
        $adminback->role                = $user->role;
        $adminback->first_name          = $user->first_name;
        $adminback->last_name           = $user->last_name;
        $adminback->email               = $user->email;
        $adminback->email_verified_at   = $user->email_verified_at;
        $adminback->password            = $user->password;
        $adminback->phone_country       = $user->phone_country;
        $adminback->phone_verified      = $user->phone_verified;
        $adminback->phone_no            = $user->phone_no;
        $adminback->country             = $user->country;
        $adminback->nationality         = $user->nationality;
        $adminback->dob                 = $user->dob;
        $adminback->profileimg          = $user->profileimg;
        $adminback->address             = $user->address;
        $adminback->twofa               = $user->twofa;
        $adminback->twofa_status        = $user->twofa_status;
        $adminback->google2fa_secret    = $user->google2fa_secret;
        $adminback->google2fa_verify    = $user->google2fa_verify;
        $adminback->email_verify        = $user->email_verify;
        $adminback->kyc_verify          = $user->kyc_verify;
        $adminback->profile_otp         = $user->profile_otp;
        $adminback->company_type        = $user->company_type;
        $adminback->business_name       = $user->business_name;
        $adminback->business_country    = $user->business_country;
        $adminback->business_email      = $user->business_email;
        $adminback->business_first_name = $user->business_first_name;
        $adminback->business_middle_name = $user->business_middle_name;
        $adminback->business_last_name   = $user->business_last_name;
        $adminback->status              = $user->status;
        $adminback->reason              = $user->reason;
        $adminback->verifyToken         = $user->verifyToken;
        $adminback->is_logged           = $user->is_logged;
        $adminback->ipaddr              = $user->ipaddr;
        $adminback->device              = $user->device;
        $adminback->location            = $user->location;
        $adminback->type                = $user->type;
        $adminback->is_address          = $user->is_address;
        $adminback->referral_id         = $user->referral_id;
        $adminback->parent_id           = $user->parent_id;
        $adminback->remember_token      = $user->remember_token;
        $adminback->created_at          = $user->created_at;
        $adminback->updated_at          = $user->updated_at;
        $adminback->save();
        return $adminback;
    }

    public static function updateUserkyc($kyc)
    {
        $adminback = UserKyc::where('id',$kyc->kyc_id)->first();
        if(!$adminback){
           $adminback = new UserKyc;
           $adminback->id = $kyc->kyc_id;
           $adminback->uid = $kyc->uid;
        }
        $adminback->fname                = $kyc->fname;
        $adminback->lname                = $kyc->fname;
        $adminback->dob                  = $kyc->dob;
        $adminback->city                 = $kyc->city;
        $adminback->country              = $kyc->country;
        $adminback->address              = $kyc->address;
        $adminback->id_type              = $kyc->id_type;
        $adminback->id_number            = $kyc->id_number;
        $adminback->id_exp               = $kyc->id_exp;
        $adminback->front_img            = $kyc->front_img;
        $adminback->back_img             = $kyc->back_img;
        $adminback->selfie_img           = $kyc->kyc_verify;
        $adminback->proofpaper           = $kyc->selfie_img;
        $adminback->status               = 1;
        $adminback->remark               = $kyc->remark;
        $adminback->created_at           = $kyc->created_at;
        $adminback->updated_at           = $kyc->updated_at;
        $adminback->save();
        return $adminback;
    }

}
