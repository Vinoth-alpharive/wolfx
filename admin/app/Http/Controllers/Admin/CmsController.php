<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;

class CmsController extends Controller
{
    public function __construct()
     {
        $this->middleware('admin');
     }

    

    public function edit($key)
     {
      
      $Data = "";

      if($key == 'homecontent'){

        $Data = GeneralSetting::on('mysql2')->Where('key',$key)->get();

        $keyname = GeneralSetting::on('mysql2')->Where('key',$key)->select('key')->first();
        
        return view('Cms.featureedit',['Data'=>$Data,'keyname' => $keyname]);

      }
      else{
        $Data = GeneralSetting::on('mysql2')->Where('key',$key)->first();

        return view('Cms.Cmssecrutiyedit',['Data'=>$Data]);
      }
       
       
       
     }

    public function update(Request $request)
     {

      if($request->key == "homecontent"){
        
        $request->validate([

          'key' =>'nullable',
          'title'=>'required',
          'description' =>'nullable'

        ]);
        //dd($request);

        $colcount = count($request->title);
        
        for($i = 0; $i < $colcount; $i++){

          if(isset($request->image[$i])){
            $pho = $request->image[$i];
            $filenamewithextension = $pho->getClientOriginalName();
            $photnam = time()."".rand();
            $filename = pathinfo($photnam, PATHINFO_FILENAME);
            $extension = $pho->getClientOriginalExtension();
            $photo = $filename . '.' . $extension;
            $path = public_path().'/images/contentimage';
            $pho->move($path, $photo);
          }
          
          $Data = GeneralSetting::on('mysql2')->where(['key' => $request->key,'id' => $request->descid[$i]])->update([
            'title' => $request->title[$i],
            'description' => $request->description[$i],
            'image' => $photo,
          ]);
          

        }
        
        

      }
      else{

        $request->validate([

          'key' =>'nullable',
          'title'=>'required',
          'description' =>'nullable'

        ]);
        //dd($request);
        
        $Data = GeneralSetting::on('mysql2')->where('key',$request->key)->first();

        $Data->title =$request->title;
        $Data->description =$request->description;

        $Data->save();

      }

        
      //dd($Data);
      return redirect('admin/dashboard')->with('status','updated successfully');

      //return redirect('admin/cmscontentedit/security')->with('status','updated successfully');

     }
     
}
