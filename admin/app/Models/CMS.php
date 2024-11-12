<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
    protected $table = 'cms';


    public static function index()
    {
        $terms = CMS::on('mysql2')->where('id', 1)->first();

        return $terms;
    }

    public static function updateTerms($request)
    {
        $tc = $request->tc;
        $tc = str_replace("\r\n",'', $tc);
        $message = "";
        if($tc !='')
        {
            $update = CMS::on('mysql2')->where('id', 1)->update(['tc' => $tc]);
            if($update)
            {
                $message = "Updated Successfully!";
            }
        }
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updatePrivacy($request)
    {
        $privacy_policy = $request->privacy;
        $privacy_policy = str_replace("\r\n",'', $privacy_policy);

        if($privacy_policy !='')
        {
            $update = CMS::on('mysql2')->where('id', 1)->update(['privacy_policy' => $privacy_policy]);

            if($update)
            {
                $message = "Updated Successfully!"; 
            }
        }
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updatePrivacyServices($request)
    {
        $termsservice = $request->termsservice;
        $termsservice = str_replace("\r\n",'', $termsservice);

        if($termsservice !='')
        {
            $update = CMS::on('mysql2')->where('id', 1)->update(['termsservice' => $termsservice]);

            if($update)
            {
                $message = "Updated Successfully!"; 
            }
        }
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updateHomepage($request)
    {

        $homebanner_title = $request->homebanner_title;
        $homebanner_title = str_replace("\r\n",'', $homebanner_title);

        $homebanner = $request->homebanner;
        $homebanner = str_replace("\r\n",'', $homebanner);

        if($homebanner_title !='' && $homebanner)
        {
            $update = CMS::on('mysql2')->where('id', 1)->update(['homebanner_title' => $homebanner_title , 'homebanner' => $homebanner]);

            if($update)
            {
                $message = "Updated Successfully!"; 
            }
        }
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

     public static function updateLivepage($request)
    {
        $livepriceupdate = $request->liveprice;
       /* 

        if($livepriceupdate)
        {*/
            $update = CMS::on('mysql2')->where('id', 1)->update(['homepage_liveprice_view' => $livepriceupdate]);

            if($update)
            {
                $message = "Updated Successfully!"; 
            }
             else
             {
               $message = "Fields Are Empty. Try Again!";
            }
     /*   }
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }*/

        return $message;
    }

    public static function updateAbout($request)
    {
        $aboutus = $request->aboutus;
        $aboutus = str_replace("\r\n",'', $aboutus);
        if($aboutus !='')
        {
            $update = CMS::on('mysql2')->where('id', 1)->update(['aboutus' => $aboutus]);
            if($update)
            {
                $message = "Updated Successfully!";
            }
        }
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

    public static function updateKyc($request)
    {

        //dd($request->kyc_content);
        $kyc_content = str_replace("\r\n",'', $request->kyc_content);
        $kycaccess = $request->kycaccess;
        $twofawithdraw = $request->twofawithdraw;

        /*if($kyc_content !='')
        {*/
            $update = CMS::on('mysql2')->where('id', 1)->update(['kyc_content' => $kyc_content,'kyc_enable' => $kycaccess,'twofa_withdraw_enable' => $twofawithdraw]);
            if($update)
            {
                $message = "Updated Successfully!";
            }
        /*}
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }*/

        return $message;
    }

public static function updateAml($request)
    {
        $aml = $request->aml;
        $aml = str_replace("\r\n",'', $aml);
        $message = "";
        if($aml !='')
        {
            $update = CMS::on('mysql2')->where('id', 1)->update(['aml' => $aml]);
            if($update)
            {
                $message = "Updated Successfully!";
            }
        }
        else
        {
            $message = "Fields Are Empty. Try Again!";
        }

        return $message;
    }

}
