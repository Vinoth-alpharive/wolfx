<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\Features;
use App\Models\Faq;
use App\Models\HowWorks;
use App\Models\SocialMedia;
use App\Models\Partner;
use App\Models\Newspage;
use Illuminate\Support\Facades\Validator;
use Storage;


class SettingsController extends Controller
{
    public function logo()
    {
        $terms = CMS::index();

        return view('settings.logo', ['logo' => $terms]);
    }

    public function tc()
    {
        $terms = CMS::index();
        return view('settings.tc', ['terms' => $terms]);
    }

    public function update_terms(Request $request)
    {

        $this->validate($request, [
        'tc' => 'required'
        ]);


        $update = CMS::updateTerms($request);
        
        return back()->with('status',$update);
    }

    public function privacy()
    {
        $terms = CMS::index();

        return view('settings.privacy', ['privacy' => $terms]);
    }

    public function updatePrivacy(Request $request)
    {

        $update = CMS::updatePrivacy($request);

        return back()->with('status',$update);
    }

    public function aboutus()
    {
        $aboutus = CMS::index();

        return view('settings.aboutus', ['aboutus' => $aboutus]);
    }

    public function updateAbout(Request $request)
    {

        $update = CMS::updateAbout($request);

        return back()->with('status',$update);
        
    }

    public function features()
    {
        $features = Features::on('mysql2')->get();

        return view('settings.features')->with('features',$features);
    }

    public function features_settings(Request $request)
    { 

        $features = Features::updateFeatures($request);

        return back()->with('status',$features);
    } 

    public function howitworks()
    {
        $features = HowWorks::on('mysql2')->get();
        return view('settings.howitworks')->with('features',$features);
    }

    public function howitworks_update(Request $request)
    { 
        $features = HowWorks::updateHowWorks($request);
        return back()->with('status',$features);
    } 

    public function faq()
    { 
        $faq = Faq::on('mysql2')->get();

        return view('settings.faq')->with('faq',$faq);
    }

    public function faq_add()
    {
        return view('settings.faq_add');
    }
     public function faq_save(Request $request)
    { 
        $heading  = $request->heading;
        $description  = $request->description;
        if($heading !="" && $description !="")
        {
            $faq = Faq::saveFaq($request);
            return redirect('admin/faq')->with('success','Added Successfully');
        }
        else
        {
          return redirect('admin/faq_add')->with('failed','Fields required!');

        }

    
    }

    public function faq_edit($id)
    {
        $faq = Faq::edit($id);

        return view('settings.faq_edit')->with('faq',$faq);
    }

     public function faq_remove($id)
    {
        $faq = Faq::remove($id);

        return redirect('admin/faq')->with('success','Removed Successfully');
    }

    public function faq_update(Request $request)
    { 

        $heading  = $request->heading;
        $description  = $request->description;
        if($heading !="" && $description !="")
        {
            $faq = Faq::faqUpdate($request); 

            return redirect('admin/faq')->with('success',$faq);
         }
        else
        {
          return redirect('admin/faq_add')->with('failed','Fields required!');

        }

    }

    public function socialMedia()
    {
        $socialMedia = SocialMedia::index();
        return view('settings.social_media')->with('link',$socialMedia);
    }

    public function saveSocialMedia(Request $request)
    {

        $socialMedia = SocialMedia::saveSocialMedia($request); 

        return back()->with('success', 'Social Media Setting Updated Successfully!');
    }
    public function securityview()
    {
        $terms = CMS::index();

        return view('settings.kyc', ['terms' => $terms]);
    }

     public function update_kyc(Request $request)
    {

        $update = CMS::updateKyc($request);
        
        return back()->with('status',$update);
    }

    public function partner()
    {
        $partner = Partner::paginate(10);

        return view('settings.partner', ['partner' => $partner]);
    }
    public function addpartner()
    {
        return view('settings.add_partner');
    }
    public function update_partner(Request $request)
    {
        $pho = $request->image;
        $filenamewithextension = $pho->getClientOriginalName();
        $photnam = str_replace('.','',microtime(true));
        $filename = pathinfo($photnam, PATHINFO_FILENAME);
        $extension = $pho->getClientOriginalExtension();
        $photo = $filename . '.' . $extension;
        Storage::disk('partner')->put($photo, fopen($request->file('image'), 'r+'));


        $Partner = new Partner();
        $Partner->image = $photo;
        $Partner->save();
        return back()->with('status','Patners Logo Added Successfully');
    }

    public function partner_remove($id)
    {
        $id =\Crypt::decrypt($id);


        $Partner = Partner::where('id',$id)->first();
        if($Partner->image != ""){
                Storage::disk('partner')->delete($Partner->image);
            }

        $faq = Partner::where('id',$id)->delete();

        return redirect('admin/partner')->with('success','Removed Successfully');
    }
	 public function termServices()
    {
        $terms = CMS::index();
        return view('settings.termsservice', ['terms' => $terms]);
    }

    public function saveTermServices(Request $request)
    {

        $update = CMS::updatePrivacyServices($request);
        
        return back()->with('status',$update);
    }

    public function homePage()
    {
        $terms = CMS::index();
        return view('settings.homepage', ['terms' => $terms]);
    }

    public function saveHomepage(Request $request)
    {

           $this->validate($request, [
        'homebanner_title' => 'required',
        'homebanner' => 'required',
        ]);


        $update = CMS::updateHomepage($request);
        
        return back()->with('status',$update);
    }

     public function livepriceview()
    {
        $terms = CMS::index();
        return view('settings.livepricepage', ['terms' => $terms]);
    }

    public function viewLiveprice(Request $request)
    {

           $this->validate($request, [
        'liveprice' => 'required',
        ]);


        $update = CMS::updateLivepage($request);
        
        return back()->with('status',$update);
    }

     public function AML()
    {
        $terms = CMS::index();
        return view('settings.aml', ['terms' => $terms]);
    }

    public function update_aml(Request $request)
    {

        $this->validate($request, [
        'aml' => 'required'
        ]);


        $update = CMS::updateAml($request);
        
        return back()->with('status',$update);
    }
    public function NewsPage()
    {

        $news = Newspage::paginate(10);

        return view('settings.newspage', ['banner' => $news]);
    }

    public function Newsadd()
    {

        return view('settings.addnewspage');
    }

    public function NewsPageEdit($id)
    {
        $id =\Crypt::decrypt($id);
        $news = Newspage::where('id',$id)->first();
        return view('settings.editnewspage', ['news' => $news]);
    }

    public function Addnews(Request $request)
    {
        $validator = $this->validate($request, [
        'title'  => 'required|max:190',
        'desc' => 'required',
        'upload_cont_img' =>  'required|mimes:jpeg,jpg,png|max:2048',
        ]); 


        $title = $request->title;
        $desc = $request->desc;
        $id = $request->id;

        $title = str_replace("\r\n",'', $title);
        $desc = str_replace("\r\n",'', $desc);


        $pho = $request->upload_cont_img;
        $filenamewithextension = $pho->getClientOriginalName();
        $photnam =str_replace('.','',microtime(true));
        $filename = pathinfo($photnam, PATHINFO_FILENAME);
        $extension = $pho->getClientOriginalExtension();
        $photo = $filename . '.' . $extension;
        Storage::disk('ftpnews')->put($photo, fopen($request->file('upload_cont_img'), 'r+'));  
        $img = 'assets/images/news/'.$photo;
         $insert = new Newspage();
         $insert->title = $title;
         $insert->desc = $desc;
         $insert->img = $img;
         $insert->save();

         return redirect('admin/news')->with('status','Added Successfully!');
    }




    public function UpdateNews(Request $request)
    {
        $validator = $this->validate($request, [
        'title'  => 'required|max:190',
        'desc' => 'required'
        ]); 


        $title = $request->title;
        $desc = $request->desc;
        $id = $request->id;

        $title = str_replace("\r\n",'', $title);
        $desc = str_replace("\r\n",'', $desc);


        $update = Newspage::on('mysql2')->where(['id' => $id])->first();

        if($request->upload_cont_img)
        {
            $pho = $request->upload_cont_img;
            $filenamewithextension = $pho->getClientOriginalName();
            $photnam =str_replace('.','',microtime(true));
            $filename = pathinfo($photnam, PATHINFO_FILENAME);
            $extension = $pho->getClientOriginalExtension();
            $photo = $filename . '.' . $extension;
            if($update->img != ""){
                Storage::disk('ftpnews')->delete($update->img);
            }
            Storage::disk('ftpnews')->put($photo, fopen($request->file('upload_cont_img'), 'r+'));

            $img = 'assets/images/news/'.$photo;
        }
        else
        {
            $img = Newspage::on('mysql2')->where(['id' => $id])->value('img');
        }

        $update->title = $title;
        $update->desc = $desc;
        $update->img = $img;
        $update->save();

         return back()->with('status','Updated Successfully!');
    }

     public function Newsdelete($id)
    {
        $id =\Crypt::decrypt($id);
        $news = Newspage::where('id',$id)->first();
        Storage::disk('ftpnews')->delete($news->img);
        $remove = Newspage::where('id',$id)->delete();
        return back()->with('status','Deleted Successfully!');
    }


}
