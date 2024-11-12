<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Crypt;

class Featurecontroller extends Controller
{
    public function __construct()
    {
    $this->middleware('admin');
    }

    public function index(Request $request){

        $index = GeneralSetting::where(['key' => 'feature', 'status' => 0])->orderby('id','desc')->paginate(15);
        
        return view('Cms.feature',(['index' => $index]));

    }

    public function add(Request $request){

        return view('Cms.featureadd');

    }

    public function insert(Request $request,$key){

        $request->validate([

            'key' =>'nullable',
            'title'=>'required',
            'description' =>'nullable',
            'image' => 'required|mimes:svg,png,jpeg,jpg',
  
        ]);
        

        if(isset($request->image)){
            $pho = $request->image;
            $filenamewithextension = $pho->getClientOriginalName();
            $photnam = time()."".rand();
            $filename = pathinfo($photnam, PATHINFO_FILENAME);
            $extension = $pho->getClientOriginalExtension();
            $photo = $filename . '.' . $extension;
            $path = public_path().'/images/contentimage';
            $pho->move($path, $photo);
        }

        $Data = GeneralSetting::on('mysql2')
        ->insert([

            'title' => $request->title,
            'description' => $request->description,
            'image' => $photo,
            'key' => $key,

        ]);

        return back()->with('status','Feature added successfully');

    }

    public function edit(Request $request,$key,$id){

        $id = Crypt::decrypt($id);

        if($key == 'feature'){

            $Data = GeneralSetting::on('mysql2')->Where(['id' => $id,'key' => $key])->first();
    
        }

        return view('Cms.featureedit',(['Data'=>$Data]));

    }
    
    public function update(Request $request){

        $id = Crypt::decrypt($request->featureid);
        
        $request->validate([

            'key' =>'nullable',
            'title'=>'required',
            'description' =>'nullable',
            'image' => 'nullable|mimes:svg,png,jpeg,jpg',
  
        ]);

        

        $Data = GeneralSetting::on('mysql2')->where(['id' => $id,'key' => $request->key])->first();

        $Data->title =$request->title;
        $Data->description =$request->description;
        // $Data->image =$photo;
        try {
        if(isset($request->image)){
            $pho = $request->image;
            $filenamewithextension = $pho->getClientOriginalName();
            $photnam = time()."".rand();
            $filename = pathinfo($photnam, PATHINFO_FILENAME);
            $extension = $pho->getClientOriginalExtension();
            $photo = $filename . '.' . $extension;
            $path = public_path().'/images/contentimage';
            $pho->move($path, $photo);
            $Data->image =$photo;
        }
        else{
            $Data->image =$Data->image;
        }
        }catch (Exception $e) { 
            $Data->image = $Data->image;
        }

        $Data->save();

        return back()->with('status','Feature edited successfully');

    }

    public function delete($id){

        $id = Crypt::decrypt($id);
        $delete = GeneralSetting::on('mysql2')->where(['id' => $id])
        ->update([
            'status' => 1,
        ]);

        return back()->with('status','Feature deleted successfully');

    }



}
