<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Commission;
use App\Models\Bankuser;
use App\Models\PurchaseHistory;
use App\Models\SellRequest;
use App\Models\Category;
use App\Models\Notification;
use App\Models\PhotoSlip;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\User;
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

    public function exchange()
    {
        try {
            $user = Auth::user();
            $role = $user->user_role;
            $rolesArray = explode(',', $role);
            $sellRequest = SellRequest::whereIn('category', $rolesArray)->where(['status' => 0, 'is_hold' => 0])->get();
            return view('exchange.sellrequest', ['request' => $sellRequest, 'price' => $user->price]);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function purchaseHistory(Request $request)
    {
        $user = Auth::id();
        $purchase = PurchaseHistory::where('buyerid', $user)->orderBy('created_at', 'desc')->get();
        return view('exchange.purchasehistory', (['purchaseHistory' => $purchase]));
    }

    public function CompleteSell(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if ($validator->fails()) {

                $firstError = $validator->errors()->first();
                return redirect('sellorder')->with('error', $firstError)->withInput();
            }
            $id = $request->id;
            $sellRequest = SellRequest::where(['id' => $id, 'is_hold' => 0, 'status' => 0])->first();
            if ($sellRequest) {

                $buyer = Auth::user();
                $seller = User::find($sellRequest->uid);

                //Match History
                $unique = false;
                while (!$unique) {
                    $transaction = Str::random(12);
                    $check = PurchaseHistory::where(['transferId' => $transaction])->first();
                    if (!$check) {
                        $unique = true;
                    }
                }

                $ph = new PurchaseHistory;
                $ph->requestId = $sellRequest->id;
                $ph->transferId = $transaction;
                $ph->buyerid = $buyer->id;
                $ph->sellerid = $seller->id;
                $ph->buyername = $buyer->username;
                $ph->sellername = $seller->username;
                $ph->value = $sellRequest->value;
                $ph->qty = $sellRequest->qty;
                $ph->account_name = $sellRequest->account_name;
                $ph->ifsc = $sellRequest->ifsc;
                $ph->account_number = $sellRequest->account_number;
                $ph->status = 0;
                $ph->expired_at = Carbon::now()->addMinutes(15);
                $ph->remark = 'PENDING';
                $ph->save();

                $sellRequest->is_hold = 1;
                $sellRequest->buid = $buyer->id;
                $sellRequest->remark = 'Buyer Match';
                $sellRequest->status = 1;
                $sellRequest->buyername = $buyer->username;
                $sellRequest->save();

                $noti = new Notification;
                $noti->uid = $ph->sellerid;
                $noti->message = $ph->buyername . " Match for " . $ph->value . ' Order';
                $noti->save();

                return redirect()->route('payment', ['code' => $transaction]);

            } else {
                return redirect('exchange')->with('error', 'Order Already Match');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return response()->json([$e->getMessage()]);
        }
    }

    public function paymentdetails($code)
    {
        if ($code) {
            $history = PurchaseHistory::where(['transferId' => $code])->first();
            if ($history) {
                return view('exchange.take-it', ['data' => $history]);
            } else {
                return redirect('exchange')->with('error', 'Invalid Request');
            }
        } else {
            return redirect('exchange')->with('error', 'Invalid Request');
        }
    }

    public function slipupload(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'slip' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);
            if ($validator->fails()) {
                $firstError = $validator->errors()->first();
                return back()->with('error', $firstError)->withInput();
            }

            if ($request->hasFile('slip')) {

                $id = $request->id;
                $ph = PurchaseHistory::where(['id' => $id])->first();

                // $file = $request->slip;
                // $fileName = time() . '_' . $file->getClientOriginalName();
                // $destinationPath = public_path('buyerimg');
                // $file->move($destinationPath, $fileName);
                // $ph->slip = $fileName;
                $ph->expired_at = Carbon::now()->addMinutes(15);
                $ph->buyer_remark = "SlipUploaded";
                $ph->status = 1;

                $noti = new Notification;
                $noti->uid = $ph->sellerid;
                $noti->message = $ph->buyername . "  for " . $ph->value . ' uploads Slip';
                $noti->save();

                $photoTable = new PhotoSlip;

                $files1 = $request->slip;
                $fileNames1 = time() . '_' . $files1->getClientOriginalName();
                $destinationPath = public_path('buyerimg');
                $files1->move($destinationPath, $fileNames1);

                $photoTable->purchase_id = $ph->id;
                $photoTable->slip_name = $fileNames1;
                $photoTable->save();
                
                if ($request->hasFile('slip1')) {
                    
                    $slipCountsPhoto = count($request->slip1);

                    for($a = 0; $a < $slipCountsPhoto; $a++){
                        $photoTables = new PhotoSlip;
                        $file1 = $request->slip1[$a];
                        $fileName1 = time() . '_' . $file1->getClientOriginalName();
                        $destinationPath = public_path('buyerimg');
                        $file1->move($destinationPath, $fileName1);

                        $photoTables->purchase_id = $ph->id;
                        $photoTables->slip_name = $fileName1;
                        $photoTables->save();

                    }

                }
                $ph->save();

                return redirect('exchange-history')->with('success', 'Slip uploaded successfully!');
            } else {
                return back()->with('error', 'There was a problem uploading the slip.');
            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}