<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Session;
use App\Models\User;
use App\Models\Admin;
use App\Models\Purchase;
use App\Models\Category;
use App\Models\SellRequest;
use App\Models\UserWallet;
use App\Models\PhotoSlip;
use Illuminate\Support\Facades\Crypt;


class PendingController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function categoryList()
    {
        $data = Category::paginate(5);
        return view('category.category', ['data' => $data]);
    }

    public function addCategoryForm()
    {
        return view('category.addcategory');
    }

    public function editPage($id)
    {
        $id = Crypt::decrypt($id);
        $cat = Category::where(['id' => $id])->first();
        return view('category.editpage', ['data' => $cat]);
    }

    public function editCategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'id' => 'required',
            'status' => 'required',
            'info' => 'required',

        ]);

        $cat = Category::where(['id' => $request->id])->first();
        if ($cat) {
            $cat->name = $request->name;
            $cat->price = $request->price;
            $cat->status = $request->status;
            $cat->info = $request->info;
            $cat->save();

            return back()->with('success', 'category Updated');
        } else {
            return back()->with('error', 'category Not Found');
        }
    }

    public function addCategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
            'info' => 'required',
        ]);

        $check = Category::where(['type' => $request->type])->first();
        if (!$check) {

            $cat = new Category;
            $cat->name = $request->name;
            $cat->type = $request->type;
            $cat->price = $request->price;
            $cat->info = $request->info;
            $cat->status = 1;
            $cat->save();
            return back()->with('success', 'category Added');
        } else {
            return back()->with('error', 'category Already have');
        }
    }

    public function getPendingPurchase()
    {
        $data = Purchase::where(['status' => 3, 'seller_remark' => 'Deny'])->paginate(10);
        return view('purchase.pendingPurchase', ['purchase' => $data]);
    }

    public function purchaseHistory()
    {
        $data = Purchase::where(['status' => 4])->paginate(10);
        return view('purchase.purchasehistory', ['purchase' => $data]);
    }

    public function viewpurchaseHistory(Request $request,$id){
        
        $id = Crypt::decrypt($id);
        $data = Purchase::where(['id' => $id, 'status' => 4])->first();
        $photo = PhotoSlip::where('purchase_id', $id)->get();
        return view('purchase.viewcompletedpurchase', ['trades' => $data,'photoSlips' => $photo]);
        
    }

    public function viewPendingpurchase(Request $request, $id)
    {

        $id = Crypt::decrypt($id);
        $data = Purchase::where(['id' => $id, 'status' => 3])->first();
        $photo = PhotoSlip::where('purchase_id', $id)->get();
        return view('purchase.viewpendingpurchase', ['trades' => $data,'photoSlips' => $photo]);
    }

    public function completePurchase(Request $request)
    {

        $this->validate($request, [
            'status' => 'required',
        ]);
        
        try {

            // dd($request->all());
            $id = $request->id;
            $status = $request->status;

            $purchase = Purchase::where(['id' => $id])->first();
            if ($purchase) {
                if ($status == 1) {

                    $sellerid = $purchase->sellerid;
                    $buyerid = $purchase->buyerid;
                    $buyer = User::find($buyerid);

                    $sellerwallet = UserWallet::where(['uid' => $sellerid, 'currency' => 'USDT'])->first();
                    $buyerwallet = UserWallet::where(['uid' => $buyerid, 'currency' => 'USDT'])->first();

                    $sellerwallet->escrow_balance -= $purchase->qty;
                    $sellerwallet->save();

                    $calculatedQty = $purchase->value / $buyer->price;
                    $calculatedQty = round($calculatedQty, 2);
                    $buyerwallet->balance += $calculatedQty;
                    $buyerwallet->save();

                    $sellrequest = SellRequest::where(['id' => $purchase->requestId])->first();
                    $sellrequest->remark = 'ADMIN COMPLETED';
                    $sellrequest->save();

                    $purchase->status = 4;
                    $purchase->remark = 'COMPLETED';
                    $purchase->save();
                    return redirect('admin/pendingpurchase')->with('success', 'Updated Successfully!');

                } else {

                    $purchase->status = 5;
                    $purchase->remark = 'CANCELLED';
                    $purchase->save();
                    $sellrequest = SellRequest::where(['id' => $purchase->requestId])->first();
                    $sellrequest->is_hold = 0;
                    $sellrequest->status = 0;
                    $sellrequest->save();
                    return redirect('admin/pendingpurchase')->with('success', 'Updated Successfully!');
                }

            } else {
                return back()->with('error', 'Invalid Request');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

}