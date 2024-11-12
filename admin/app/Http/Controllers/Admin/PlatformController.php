<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Crypt;

class PlatformController extends Controller
{
    public function __construct()
    {
    $this->middleware('admin');
    }

    public function index(Request $request){

        $index = GeneralSetting::where(['key' => 'platform', 'status' => 0])->orderby('id','desc')->paginate(15);
        
        return view('Cms.Platform.platform',(['index' => $index]));

    }

    public function add(Request $request){

        return view('Cms.Platform.platformadd');

    }

    public function insert(Request $request,$key){

        

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

        if($key == 'platform'){

            $Data = GeneralSetting::on('mysql2')->Where(['id' => $id,'key' => $key])->first();
    
        }

        return view('Cms.Platform.advantageedit',(['Data'=>$Data]));

    }
    
    public function update(Request $request){

        $id = Crypt::decrypt($request->featureid);
        
        $request->validate([

            'key' =>'nullable',
            'title'=>'required',
            'description' =>'nullable'
  
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
