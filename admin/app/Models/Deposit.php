<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Mail\DepositEmail;

class Deposit extends Model
{
    protected $table = "deposits";
     protected $connection = 'mysql2';

    // public static function depsoitListall($currency)
    // {
    //     $list = Deposit::on('mysql2')->where(['currency' => $currency])->orderBy('id', 'desc')->paginate(10); 

    //     return $list;
    // }

    public static function depsoitListall($currency)
    {
        $list = Deposit::on('mysql2')
        ->where('currency', $currency)
            ->orderByRaw('
            CASE 
                WHEN status = 0 THEN 1  -- Pending
                WHEN status = 1 THEN 2  -- Complete
                WHEN status = 2 THEN 3  -- Rejected
                ELSE 4  -- Other statuses, if any
            END
        ')
            ->orderBy('id', 'desc')  // Secondary sorting by ID in descending order
            ->paginate(10);

        return $list;
    }


      public static function depsoitView($id)
    {
        $list = Deposit::on('mysql2')->where('id',$id)->first(); 
        
        return $list;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'uid', 'id');
    }

    public static function user_name_search($q, $searchitem, $status = null)
    {
        $coin = $q->coin;

        // Initialize the query
        $query = Deposit::where('currency', $coin)
            ->where(function ($query) use ($searchitem) {
                $query->where('txid', 'LIKE', '%' . $searchitem . '%')
                    ->orWhereRaw("concat(txid, ' ', txid) like '%" . $searchitem . "%'");
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




    public static function statusUpdate($request)
    {
        $id = $request->id;
        $amount = $request->amount;
        $status = $request->status;
        $credit_amount = $request->credit_amount;
        
        $deposit_data = Deposit::on('mysql2')->where('id', $id)->first();


            if($deposit_data)
            { 
                if($status == 1)
                {
                    $updateBal = UserWallet::on('mysql2')->where('uid',$deposit_data->uid)->where('currency',$deposit_data->currency)->first();


                    if(isset($updateBal->balance))
                    {
                         $oldbalance  =  $updateBal->balance;
                        $updateBal->balance = ncAdd($updateBal->balance , $request->credit_amount); 
                        $updateBal->site_balance = ncAdd($updateBal->site_balance , $request->credit_amount); 
                        $updateBal->save();
                        $walletbalance  =  $updateBal->balance;

                    }
                    else
                    {
                        $oldbalance  =  0;
                        $balance = new UserWallet;
                        $balance->setConnection('mysql2');
                        $balance->uid = $deposit_data->uid;
                        $balance->currency = $deposit_data->currency;
                        $balance->balance = $request->credit_amount;
                        $balance->escrow_balance = 0;
                        $balance->site_balance = $request->credit_amount;
                        $balance->save();
                        $walletbalance  =   $request->credit_amount;

                    }               

                    $status1 = 'Accept'; 

                    $uid = $deposit_data->uid;
                    $currency = $deposit_data->currency;
                    $amount = $deposit_data->credit_amount; 

                    self::AllcoinUpdateBalanceTrack($uid,$currency,$amount,$walletbalance,$oldbalance,$deposit_data->id);

                    
                }
                else
                {
                     $status1 = 'Cancel'; 
                }
                $deposit_data->credit_amount = $request->credit_amount;
                $deposit_data->status = $status;
                $deposit_data->save();

            }

            $user = User::on('mysql2')->where('id',$deposit_data->uid)->first(); 
           
            $details = array(
                'status'    => $status1,
                'coin'      => $deposit_data->currency,
                'amount'    => $amount,
                'user'      => $user->name 
            ); 
            
            \Mail::to($user->email)->send(new DepositEmail($details));

            return true;

    }


    public static function AllcoinUpdateBalanceTrack($uid,$currency,$amount,$walletbalance,$oldbalance,$insertid)
    {

        $Models = '\App\Models\OverallTransaction';
        $remark = $currency.' deposit';
        $Models::AddTransaction($uid,$currency,'deposit',$amount,0,$walletbalance,$oldbalance,$remark,'Admin',$insertid);

        return true;
    }


}
