<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\UserKyc;

class KycSubmit extends Model
{
    protected $table = 'kyc';
    protected $connection = 'mysql2';

    public static function index()
    {
    	$kyc = KycSubmit::on('mysql2')->orderBy('id','desc')->paginate(10);

    	return $kyc;
    }

   	public static function edit($id)
    {
    	$kyc = KycSubmit::on('mysql2')->where('id',$id)->first();

    	return $kyc;
    }

    public static function updateKyc($request)
    { 
         //dd($request);
        $kyc_id = $request->kyc_id; 
        $status = $request->status;
        $remark = $request->remark;
        $fname = $request->fname;
        $lname = $request->lname;
        $gender_type = $request->gender_type;
        $dob = $request->dob;
        $state = $request->state;
        $city = $request->city;
        $zip_code = $request->zip_code;
        $country = $request->country;
        $id_exp = $request->id_exp;
        $telegram_name = $request->telegram_name;
        $address_line1 = $request->address_line1;
        $address_line2 = $request->address_line2;
        $id_type = $request->id_type;
        $id_number = $request->id_number;
        $uid = $request->uid;

        if($status == 1){
            $kyc_verify = 1;
         

        } elseif($status == 2){
            $kyc_verify = 0;
        } else {
           $kyc_verify = 2; 
        }

        KycSubmit::on('mysql2')->where('id', $kyc_id)->update(['fname' => $fname,'lname' => $lname,'gender_type' => $gender_type,'dob' => $dob,'state' => $state,'city' => $city,'zip_code' => $zip_code,'country' => $country,'telegram_name' => $telegram_name,'address_line1' => $address_line1,'address_line2' => $address_line2,'id_type' => $id_type,'id_number' => $id_number,'id_exp' => $id_exp,'status' => $status,'remark' => $remark]);

        User::on('mysql2')->where('id', $uid)->update(['kyc_verify' => $kyc_verify]); 
        
        return true; 
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
}
