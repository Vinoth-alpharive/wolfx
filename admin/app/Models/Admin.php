<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin_userside;

class Admin extends Model
{
    public static function login($request)
    {
    	$admin = Admin::where('email', $request->email)->first();
    	if(isset($admin->password) && password_verify ($request->password , $admin->password))
    	{
    		return $admin->id;
    	}
    	else
    	{
    		return false;
    	}
    }

    public static function updateUsername($request)
    {
            $email = $request->email;

            $admin = Admin::where('id',1)->first();
            $admin->email = $email;

            if($admin->save())
            {
                 $Admin_userside = Admin_userside::where('id',1)->first();
                 $Admin_userside->email = $request->email;
                 $Admin_userside->save();
                 return $messgae = "Email Changed Successfully"; 
            }
            
    }

    public static function changepassword($request)
    {
        $currentpassword = $request->currentpassword;
        $new_password = $request->password;
        $confirm_password = $request->password_confirmation;

        $admin = Admin::where('id', 1)->first();

        if(!(Hash::check($currentpassword, $admin->password)))
        {    
            return $messgae = "Your current password does not match with the password you provided. Please try again!";
        } 
        else if(strlen($new_password) <= 7)
        {
            return $messgae = "Password length should be minimum 8 characters!";
        }
        else
        {
            if($new_password == $confirm_password)
            {
                    $password = bcrypt($new_password); 
                    $admin->password = $password;

                    if($admin->save())
                    {
                        return $messgae ="Password Changed Successfully!"; 
                    }
            }
            else
            {
                return $messgae ="Password Mismatch!"; 
            }
        }
    }

    public static function subadmin_date_search($startdate,$enddate){
        
        $search = Admin::on('mysql')
        ->whereDate('created_at','>=',$startdate)
        ->whereDate('created_at','<=',$enddate)
        ->where('type','=',2)
        ->select('*')
        ->orderBy('updated_at', 'desc')
        ->paginate(25);
        return $search;

    }


}
