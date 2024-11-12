<?php

namespace App\Http\Controllers\Admin;

use App\Models\LaunchpadProject;
use App\Http\Controllers\Controller;
use App\Http\Requests\IeoRequest;
use App\Models\Commission;
use App\Models\IEOList;
use App\Models\IEOTran;
use App\Models\Tradepair;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;


class LaunchpadController extends Controller
{
    public function apply(){
        $projects = LaunchpadProject::paginate(20);

        return view('launchpad.apply',compact('projects'));
    }

    public function p2blaunchpad(){
        $ieoTokens = IEOList::paginate(20);
        return view('launchpad.p2b',compact('ieoTokens'));
    }

    public function launchpadParticipate(){
        $ieoTrans = IEOTran::paginate(20);
        $trans = [];

        foreach($ieoTrans as $key => $value){
            $user = User::find($value->uid);
            if($user){
                $trans[$key]['name'] = $user->email;
                $trans[$key]['coinone'] = $value->coinone;
                $trans[$key]['cointwo'] = $value->cointwo;
                $trans[$key]['trans_id'] = $value->trans_id;
                $trans[$key]['price'] = $value->price;
                $trans[$key]['volume'] = $value->volume;
                $trans[$key]['total'] = $value->total;
                $trans[$key]['status'] = $value->status;
                $trans[$key]['created_at'] = $value->created_at;
            }

        }
        // dd($trans);

        return view('launchpad.participates',compact('trans','ieoTrans'));
    }

    public function viewToken($id){
        $token = IEOList::find($id);
        return view('launchpad.viewtoken',compact('token','coins'));
    }

    public function addToken(){
        $coins = Commission::where('shown',1)->get()->unique('source');
        return view('launchpad.addtoken',compact('coins'));
    }

    public function insertLaunchpad(IeoRequest $request){
        // dd('working');
        $is_exits = IEOList::where(['symbol' => $request->symbol])->first();
        if($is_exits){
            return back()->with('error','Launchpad already exists!');
        }

        if(isset($request->logo)){
            $pho = $request->logo;
            $filenamewithextension = $pho->getClientOriginalName();
            $photnam = strtolower($request->symbol);
            $filename = pathinfo($photnam, PATHINFO_FILENAME);
            $extension = $pho->getClientOriginalExtension();
            $photo1 = $filename.'logo'.'.' . $extension;
            Storage::disk('ftpcoin')->put($photo1, fopen($request->file('logo'), 'r+'));
        }
        if(isset($request->banner)){
            $pho = $request->banner;
            $filenamewithextension = $pho->getClientOriginalName();
            $photnam = strtolower($request->symbol);
            $filename = pathinfo($photnam, PATHINFO_FILENAME);
            $extension = $pho->getClientOriginalExtension();
            $photo2 = $filename.'banner' . '.' . $extension;
            Storage::disk('ftpcoin')->put($photo2, fopen($request->file('banner'), 'r+'));
        }
        if(isset($request->whitepaper)){
            $pho = $request->whitepaper;
            $filenamewithextension = $pho->getClientOriginalName();
            $photnam = strtolower($request->symbol);
            $filename = pathinfo($photnam, PATHINFO_FILENAME);
            $extension = $pho->getClientOriginalExtension();
            $photo3 = $filename .'whitepaper'. '.' . $extension;
            Storage::disk('ftpcoin')->put($photo3, fopen($request->file('whitepaper'), 'r+'));
        }
        if(isset($request->presentation)){
            $pho = $request->presentation;
            $filenamewithextension = $pho->getClientOriginalName();
            $photnam = strtolower($request->symbol);
            $filename = pathinfo($photnam, PATHINFO_FILENAME);
            $extension = $pho->getClientOriginalExtension();
            $photo4 = $filename .'presentation'. '.' . $extension;
            Storage::disk('ftpcoin')->put($photo4, fopen($request->file('presentation'), 'r+'));
        }

        $launchpad = new IEOList();
        $launchpad->symbol = $request->symbol;
        $launchpad->cointwo = $request->cointwo;
        $launchpad->supply_per_session = $request->supply_per_session; 
        $launchpad->price_in_cointwo  = $request->price_in_cointwo;
        $launchpad->min_token_purchase = $request->min_token_purchase;
        
        // $launchpad->min_othercurrency_purchase = $request->min_othercurrency_purchase;
        // $launchpad->stage = $request->stage;
        $launchpad->protocol_network = $request->protocol_network;
        $launchpad->discount = $request->discount;
        $launchpad->roi = $request->roi;
        $launchpad->industry = $request->industry;
        $launchpad->website = $request->website;
        $launchpad->start_date = $request->start_date;
        $launchpad->end_date = $request->end_date;
        $launchpad->referral_commission = $request->referral_commission;
        $launchpad->referral_coin_type = $request->referral_coin_type;

        $launchpad->logo = isset($photo1) ? $photo1 : '';
        $launchpad->banner = isset($photo2) ? $photo2 : '';
        $launchpad->whitepaper = isset($photo3) ? $photo3 : '';
        $launchpad->presentation = isset($photo4) ? $photo4 : '';
        $launchpad->save();


        // User::update('is_address', 0);
        // User::where(['email_verify' => 1])->update(['is_address' => 0, 'updated_at' => date('Y-m-d H:i:s',time())]);
     

        return back()->with('status','IEO Added Successfully');
    }

    public function viewLaunchpad($id){
        $id  = Crypt::decrypt($id);
        $pad = IEOList::find($id);
        $coins = Commission::where('shown',1)->get()->unique('source');
        return view('launchpad.viewtoken',compact('pad','coins','id'));
    }

    public function updateLaunchpad(IeoRequest $request){
        $launchpad = IEOList::on('mysql2')->where('symbol', $request->symbol)->first();
        if($launchpad == ""){
            
            $launchpad = IEOList::on('mysql2')->where('id', $request->mainId)->first();
        }

        $launchpad->symbol = $request->symbol;
        $launchpad->cointwo = $request->cointwo;
        $launchpad->supply_per_session = $request->supply_per_session; 
        $launchpad->price_in_cointwo  = $request->price_in_cointwo;
        $launchpad->min_token_purchase = $request->min_token_purchase;
        $launchpad->description = $request->description;
        // $launchpad->min_othercurrency_purchase = $request->min_othercurrency_purchase;
        // $launchpad->stage = $request->stage;
        $launchpad->protocol_network = $request->protocol_network;
        $launchpad->roi = $request->roi;
        $launchpad->discount = $request->discount;
        $launchpad->industry = $request->industry;
        $launchpad->website = $request->website;
        $launchpad->start_date = $request->start_date;
        $launchpad->end_date = $request->end_date;
        $launchpad->referral_commission = $request->referral_commission;
        $launchpad->referral_coin_type = $request->referral_coin_type;




         //Color icon image
        try {
            if(isset($request->logo)){
                $pho = $request->logo;
                $filenamewithextension = $pho->getClientOriginalName();
                $photnam = strtolower($request->symbol). str_replace('.', '', microtime(true));
                $filename = pathinfo($photnam, PATHINFO_FILENAME);
                $extension = $pho->getClientOriginalExtension();
                $photo1 = $filename.'logo'.'.' . $extension;
                if($launchpad->logo != ""){
                    Storage::disk('ftpcoin')->delete($launchpad->logo);
                }
                Storage::disk('ftpcoin')->put($photo1, fopen($request->file('logo'), 'r+'));
                $launchpad->logo = $photo1;
                
            }else{
                $launchpad->logo = $launchpad->logo;
            }

            if(isset($request->banner)){
                $pho = $request->banner;
                $filenamewithextension = $pho->getClientOriginalName();
                $photnam = strtolower($request->symbol). str_replace('.', '', microtime(true));
                $filename = pathinfo($photnam, PATHINFO_FILENAME);
                $extension = $pho->getClientOriginalExtension();
                $photo2 = $filename.'banner'.'.'  . $extension;
                if($launchpad->banner != ""){
                    Storage::disk('ftpcoin')->delete($launchpad->banner);
                }
                Storage::disk('ftpcoin')->put($photo2, fopen($request->file('banner'), 'r+'));
                $launchpad->banner = $photo2;
                
            }else{
                $launchpad->banner = $launchpad->banner;
            }

            if(isset($request->whitepaper)){
                $pho = $request->whitepaper;
                $filenamewithextension = $pho->getClientOriginalName();
                $photnam = strtolower($request->symbol). str_replace('.', '', microtime(true));
                $filename = pathinfo($photnam, PATHINFO_FILENAME);
                $extension = $pho->getClientOriginalExtension();
                $photo3 = $filename.'whitepaper'.'.' . $extension;
                if($launchpad->whitepaper != ""){
                    Storage::disk('ftpcoin')->delete($launchpad->whitepaper);
                }
                Storage::disk('ftpcoin')->put($photo3, fopen($request->file('whitepaper'), 'r+'));
                $launchpad->whitepaper = $photo3;
                
            }else{
                $launchpad->whitepaper = $launchpad->whitepaper;
            }

            if(isset($request->presentation)){
                $pho = $request->presentation;
                $filenamewithextension = $pho->getClientOriginalName();
                $photnam = strtolower($request->symbol). str_replace('.', '', microtime(true));
                $filename = pathinfo($photnam, PATHINFO_FILENAME);
                $extension = $pho->getClientOriginalExtension();
                $photo4 = $filename.'presentation'.'.' . $extension;
                if($launchpad->presentation != ""){
                    Storage::disk('ftpcoin')->delete($launchpad->presentation);
                }
                Storage::disk('ftpcoin')->put($photo4, fopen($request->file('presentation'), 'r+'));
                $launchpad->presentation = $photo4;
                
            }else{
                $launchpad->presentation = $launchpad->presentation;
            }
        }catch (Exception $e) { 
            $launchpad->logo = $launchpad->logo;
            $launchpad->banner = $launchpad->banner;
            $launchpad->whitepaper = $launchpad->whitepaper;
            $launchpad->presentation = $launchpad->presentation;
        }

        
        $launchpad->logo = isset($photo1) ? $photo1 : $launchpad->logo;
        $launchpad->banner = isset($photo2) ? $photo2 : $launchpad->banner;
        $launchpad->whitepaper = isset($photo3) ? $photo3 : $launchpad->whitepaper;
        $launchpad->presentation = isset($photo4) ? $photo4 : $launchpad->presentation;
        $launchpad->save();

        return back()->with('status','IEO Updated Successfully');
    }
}
