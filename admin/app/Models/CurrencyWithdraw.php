<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail; 
use App\Mail\WithdrawEmail; 

class CurrencyWithdraw extends Model
{
	protected $table = 'withdraw_request';

    protected $connection = 'mysql2';



    // public static function histroy($type)
    // {
    // 	$histroy = CurrencyWithdraw::on('mysql2')->where('type', $type)->orderBy('id', 'desc')->paginate(15);

    // 	return $histroy;
    // }

    public static function histroy($type)
{
    $history = CurrencyWithdraw::on('mysql2')
        ->where('type', $type)
        ->orderByRaw('
            CASE 
                WHEN status = 0 THEN 1  -- Pending
                WHEN status = 1 THEN 2  -- Complete
                WHEN status = 2 THEN 3  -- Rejected
                ELSE 4  -- Other statuses, if any
            END
        ')
        ->orderBy('id', 'desc')  // Secondary sorting by ID in descending order
        ->paginate(15); 
        
    return $history;
}


     public static function user_histroy_fiat($id)
    {
        $histroy = CurrencyWithdraw::on('mysql2')->where('uid', $id)->orderBy('id', 'desc')->paginate(15);

        return $histroy;
    }

    public static function user_name_search($q, $searchitem, $status = null)
    {
        $coin = $q->coin;

        // Initialize the query
        $query = CurrencyWithdraw::where('type', $coin)
            ->where(function ($query) use ($searchitem) {
                $query->where('tran_id', 'LIKE', '%' . $searchitem . '%')
                ->orWhereRaw("concat(tran_id, ' ', tran_id) like '%" . $searchitem . "%'");
            });

        // Add date filter if provided
        if (isset($q->start_date) && isset($q->end_date)) {
            $query->whereBetween('created_at', [$q->start_date, $q->end_date]);
        }

        // Add status filter if provided
        if (!is_null($status)) {
            $query->where('status', $status);
        }

        // Return paginated results
        return $query->orderBy('updated_at', 'desc')->paginate(20);
    }




    public static function edit($id)
    {
    	$histroy = CurrencyWithdraw::on('mysql2')->where('id', $id)->first();

    	return $histroy;
    }

    public static function withdrawUpdate($request)
    {
        $id = $request->id;
        $status = $request->status;
        $currency = $request->currency;
            

         
        $deposit_data = CurrencyWithdraw::on('mysql2')->where(['id' => $request->id,'status' => 0])->first();

        if($deposit_data)
        {
            $amount = $deposit_data->request_amount;
            $uid = $deposit_data->uid;

            if($status == 2)
            {

                $user = UserWallet::on('mysql2')->where('uid',$deposit_data->uid)->where('currency',$deposit_data->type)->first();
               // dd($user);
                $oldbalance  = $user->balance;
                $user->balance = $user->balance + $deposit_data->request_amount;
                $user->site_balance = $user->site_balance + $deposit_data->request_amount;
                $user->save();
                $walletbalance  = $user->balance;


                //Track balance update 
                $currency = $deposit_data->type;

                self::AllcoinUpdateBalanceTrack($uid,$currency,$amount,$walletbalance,$oldbalance,$deposit_data->id);



                $status1 = 'Cancel'; 
            } 
            elseif($status == 1) {

                $status1 = 'Accept'; 
            }
            else
            {
                $status1 = 'Waiting for admin approval';

            }
            $deposit_data->status = $status;
            $deposit_data->save();
            
        }

        $user = User::on('mysql2')->where('id',$deposit_data->uid)->first(); 
       
         if($status == 2 || $status == 1)
            {
                    $details = array(
                        'status'=>$status1,
                        'coin'=> $deposit_data->type,
                        'amount'=>$deposit_data->request_amount,
                        'user' => $user->name 
                    ); 
                    
                    Mail::to($user->email)->send(new WithdrawEmail($details));
            }

        return true;
    }


    public static function AllcoinUpdateBalanceTrack($uid,$currency,$amount,$walletbalance,$oldbalance,$insertid)
    {
        $Models = '\App\Models\OverallTransaction';
        $remark = $currency.' Admin Rejected withdraw request';
        $Models::AddTransaction($uid,$currency,'withdraw',$amount,0,$walletbalance,$oldbalance,$remark,'admin',$insertid);
        return true;
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }
}
