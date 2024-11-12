<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Commission;
use App\Models\Bankuser;
use App\Models\PurchaseHistory;
use App\Models\SellRequest;
use App\Models\Notification;
use App\Models\Category;
use App\Models\User;
use Auth;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function setType(Request $request)
    {
        $type = $request->type;
        $user = Auth::user();
        $user->selected_type = $type;
        $user->save();
        return response()->json(['success' => true]);
    }

    public function sellcrypto()
    {
        $user = Auth::user();
        // dd($user);
        $coin = Commission::where(['source' => 'USDT'])->first();
        $bankdetails = Bankuser::where(['uid' => $user->id, 'status' => 1, 'is_primary' => 1])->first();
        $wallet = Wallet::where(['uid' => $user->id, 'currency' => 'USDT'])->first();
        $type = $user->selected_type;
        $category = Category::where(['type' => $type])->first();

        // dd($category);
        return view('exchange.sellcrypto', ['coin' => $coin, 'bank' => $bankdetails, 'wallet' => $wallet, 'category' => $category]);
    }

    public function doSellcrypto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'acc_name' => 'required|max:15',
            'ifsc' => 'required|alpha_dash',
            'acc_no' => 'required|alpha_dash|max:16',
            'amount' => 'required|numeric',
            'password' => 'required',
            // 'price' => 'required',
            // 'category' => 'required'
        ]);
        // dd($request->all());
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect('sellcrypto')
                ->with('error', $firstError)
                ->withInput();
        }

        $user = Auth::user();
        $password = $request->password;
        if (!Hash::check($password, $user->trans_password)) {
            return redirect('sellcrypto')->with('error', 'Your Password Not Match. Please try again.');
        } else {
            //check balance 
            $wallet = Wallet::where(['uid' => $user->id, 'currency' => 'USDT'])->first();
            if ($wallet) {
                $category = Category::where(['type' => $user->selected_type])->first();
                if ($category) {

                    $qty = $request->amount;
                    $price = $category->price;

                    if ($wallet->balance >= $qty) {

                        $value = bcmul($price, $qty, 8);
                        $ph = new SellRequest;
                        $ph->qty = $qty;
                        $ph->uid = $user->id;
                        $ph->account_name = $request->acc_name;
                        $ph->sellername = $user->username;
                        $ph->ifsc = $request->ifsc;
                        $ph->price = $price;
                        $ph->value = $value;
                        $ph->category = $category->type;
                        $ph->status = 0;
                        $ph->remark = "PENDING";
                        $ph->is_hold = 0;
                        $ph->account_number = $request->acc_no;
                        $ph->save();

                        $wallet->escrow_balance += $qty;
                        $wallet->balance -= $qty;
                        $wallet->save();

                        return redirect('exchange-history')->with('success', 'Order Posted');
                    } else {
                        return redirect('sellcrypto')->with('error', 'Insufficient Balance');
                    }
                }
            } else {
                return redirect('sellcrypto')->with('error', 'Wallet Not Found');
            }
        }
    }

    public function sellerComplete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            $firstError = $validator->errors()->first();
            return redirect('processing')
                ->with('error', $firstError)
                ->withInput();
        }

        $id = $request->id;
        $status = $request->status;
        $purchase = PurchaseHistory::where(['id' => $id])->first();
        $purchase->status = 3;
        $buyer = User::find($purchase->buyerid);
        $seller = Auth::user();

        if ($status == "Accept") {

            $sellerwallet = Wallet::where(['uid' => $seller->id, 'currency' => 'USDT'])->first();
            $buyerwallet = Wallet::where(['uid' => $buyer->id, 'currency' => 'USDT'])->first();

            if ($sellerwallet && $buyerwallet) {

                $sellerwallet->escrow_balance -= $purchase->qty;
                $sellerwallet->save();

                $calculatedQty = $purchase->value / $buyer->price;
                $calculatedQty = round($calculatedQty, 2);
                $buyerwallet->balance += $calculatedQty;
                $buyerwallet->save();

                $req = SellRequest::where(['id' => $purchase->requestId])->first();
                $req->remark = "COMPLETED";

                $purchase->status = 4;
                $purchase->remark = 'COMPLETED';
                $purchase->save();

                $noti = new Notification;
                $noti->uid = $buyer->id;
                $noti->message = $seller->username . " Completed " . $purchase->value . ' Order';
                $noti->save();

                $purchase->seller_remark = "Accept";
                $message = "Your Order is complete.";

            }

        } else {

            $noti = new Notification;
            $noti->uid = $buyer->id;
            $noti->message = $seller->username . " Denied " . $purchase->value . ' Order';
            $noti->save();

            $purchase->seller_remark = "Deny";
            $message = "Request Moved To Admin";
        }

        $purchase->save();
        return redirect('processing')->with('success', $message);
    }

    public function processing()
    {
        $user = Auth::id();
        $pending = PurchaseHistory::where('sellerid', $user)->whereIn('status', [1, 3])->orderBy('id', 'DESC')->get();
        return view('exchange.processing', (['pending' => $pending]));
    }

    public function processingUpdate()
    {
        $user = Auth::id();
        $pending = PurchaseHistory::where('sellerid', $user)->whereIn('status', [1, 3])->orderBy('id', 'DESC')->get();
        $data = $pending->map(function ($item) {
            return [

                'transferId' => $item->transferId,
                'buyername' => $item->buyername,
                'sellername' => $item->sellername,
                'value' => $item->value,
                'qty' => $item->qty,
                'status' => $item->status,
                'remark' => $item->remark,
                'seller_remark' => $item->seller_remark,
                'slip' => $item->slip,
                'slip1' => $item->slip1,
                'account_name' => $item->account_name,
                'ifsc' => $item->ifsc,
                'account_number' => $item->account_number,
                'created_at' => $item->created_at,
            ];
        });
        return response()->json($data);
    }

    public function orderdetails($id)
    {
        $order = PurchaseHistory::where(['transferId' => $id, 'status' => 1])->first();
        if ($order) {
            return view('exchange.confirm-status', ['data' => $order]);
        }
    }
}