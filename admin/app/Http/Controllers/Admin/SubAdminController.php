<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use App\Models\AdminProfile;
use App\Models\Admin;
use Session;
use Hashids\Hashids;
use App\Traits\GoogleAuthenticator;

class SubAdminController extends Controller
{
    use GoogleAuthenticator;
    public function __construct()
    {       
       $this->middleware(['admin']);
          
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $adminid = Session::get('adminId');

       $subadmin = AdminProfile::adminprofile(); 
        if(!in_array("read", explode(',',$subadmin->addadmin))){
          return redirect('admin/dashboard');  
        }   
      $subadmin = AdminProfile::where(['user_id' => $adminid])->first();
      $list = Admin::where('type',2)->orderBy('id','desc')->paginate(25);
      return view('adminaccount.subadminlist',['admins' => $list,'subadmin' =>  $subadmin]);
    }




 public function usersubadminsearch(Request $request)
    {  
          

         $q = $request->searchitem;


            $adminid = Session::get('adminId'); 
            $subadmin = AdminProfile::adminprofile(); 
            if(!in_array("read", explode(',',$subadmin->addadmin))){
            return redirect('admin/dashboard');  
            }     
            $limit=25;
            if(isset($_GET['page'])){
            $page = $_GET['page'];
            $i = (($limit * $page) - $limit)+1;
            }else{
            $i =1;
            }


            $list = Admin::whereNotIn('id', [1, $admin])
             ->where('name', 'LIKE', '%' . $q . '%')
            ->orderBy('id','desc')
            ->paginate(25);


         return view('adminaccount.subadminlist',['admins' => $list,'i' => $i,'subadmin' =>  $subadmin]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $adminid = Session::get('adminId'); 
       $subadmin = AdminProfile::adminprofile(); 
       if(!in_array("read", explode(',',$subadmin->addadmin)) || !in_array("write", explode(',',$subadmin->addadmin)) ){
          return redirect('admin/dashboard');  
       }  
       return view('adminaccount.subadminadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'username' => 'required|regex:/^[\pL\s\-]+$/u|max:30',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' =>'required|min:8|max:16|required_with:confirmpassword|same:confirmpassword|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirmpassword' => 'min:8',
        ],
        [
         'username' => 'User Name is required',
         'password.required' => 'The password field is required',
         'password.min' => 'Password must have minimum 8 characters',
         'password.max' => 'Password must not exceed 16 characters',
         'password.regex' => 'Password must contain atleast 1 special character and 1 uppercase letter',
        ]);
       
        
        if ($validator->fails()) {
           // dd($validator);
            return redirect('admin/subadminform')
                        ->withErrors($validator)
                        ->withInput();
        }else{ 
            
            $password = bcrypt($request->get('password'));
            $admin = new Admin;
            $admin->name = $request->get('username');
            $admin->username = $request->get('username');
            
            if(ctype_space($request->get('username'))){
              return back()->with('error','Username not accept space!!!');  
            }
            else{

            $admin->email     = $request->get('email');
            $admin->password  =  $password;
            $admin->status    =  0;
            $admin->ipaddress =  get_client_ip();
            $admin->type      =  2;
            $admin->google2fa_secret  =  $this->createSecret();
            $admin->google2fa_verify  =  0;
            //$admin->login_time = date('Y-m-d H:i:s',time());
            //$admin->logout_time = date('Y-m-d H:i:s',time());
            $admin->created_at = date('Y-m-d H:i:s',time());
            $admin->updated_at = date('Y-m-d H:i:s',time());
            // dd($admin);
            $admin->save();
            $adminid = $admin->id;
            

            $AdminProfile = new AdminProfile;
            $AdminProfile->user_id = $adminid;

            $AdminProfile->dashboard = implode(',', (array) $request->get('dashboard'));
            $AdminProfile->category = implode(',', (array) $request->get('category'));
            $AdminProfile->userlist = implode(',', (array) $request->get('userlist'));
            // $AdminProfile->tradehistory =implode(',',(array) $request->get('tradehistory'));
            // $AdminProfile->adminwallet =implode(',',(array) $request->get('adminwallet'));
            $AdminProfile->withdrawwallet =implode(',',(array) $request->get('withdrawwallet'));
            $AdminProfile->depositlist =implode(',',(array) $request->get('depositlist'));
            $AdminProfile->coinsetting =implode(',',(array) $request->get('coinsetting'));
            // $AdminProfile->subscriber =implode(',',(array) $request->get('subscriber'));
            $AdminProfile->withdrawlist =implode(',',(array) $request->get('withdrawlist'));
            // $AdminProfile->countries =implode(',',(array) $request->get('countries'));
            $AdminProfile->commissionsetting = implode(',', (array) $request->get('commissionsetting'));
            $AdminProfile->security =implode(',',(array) $request->get('security'));
            // $AdminProfile->kyc = implode(',', (array) $request->get('kyc'));
            $AdminProfile->addadmin = implode(',', (array) $request->get('addadmin'));
            // $AdminProfile->adminbank = implode(',', (array) $request->get('adminbank'));
            $AdminProfile->support = implode(',', (array) $request->get('support'));
            $AdminProfile->purchase = implode(',', (array) $request->get('purchase'));
            $AdminProfile->cms_settings = implode(',', (array) $request->get('cms'));

            // $AdminProfile->kyc_settings = implode(',', (array) $request->get('kyc_settings'));
            // $AdminProfile->contact = implode(',', (array) $request->get('contact'));
            // $AdminProfile->p2p = implode(',', (array) $request->get('p2p'));
            $AdminProfile->refferalcommission = implode(',', (array) $request->get('refferalcommission'));
            $AdminProfile->refferalhistory = implode(',', (array) $request->get('refferalhistory'));
           


            $AdminProfile->save();
            
            // dd($AdminProfile);
           
            return redirect('admin/subadminlist')->with('success','Subadmin has added successfully!');
           }
        }
        return redirect('admin/subadminform');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subadmin = AdminProfile::adminprofile(); 
        // dd($subadmin);
        if(!in_array("read", explode(',',$subadmin->addadmin))  || !in_array("write", explode(',',$subadmin->addadmin)) ){
          return redirect('admin/dashboard');  
        }     
        
        $userId = \Crypt::decrypt($id);
        
        $user = Admin::where('id', $userId)->first(); 

        //  dd($user);  
       
        if(empty($user)){
           return redirect('admin/subadminlist'); 
        }
        $profile = AdminProfile::where('user_id', $userId)->first();
         
        return view('adminaccount.subadminedit',['user' => $user,'profile' => $profile,'id' => $id]);
    }

  

    public function update(Request $request, $id)
    { 
        $userId = \Crypt::decrypt($id);
        $user = Admin::where('id', $userId)->first(); 
       
        if(empty($user)){
           return redirect('admin/subadminlist'); 
        }
        
        if($request->get('password') !='' ) {
          
           $this->validate($request, [
            'username' => 'required|regex:/^[\pL\s\-]+$/u|max:30',
            'email' => 'required|string|email|max:255',
            'password' =>'required|min:8|max:16|required_with:confirmpassword|same:confirmpassword|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirmpassword' => 'min:8|max:16|same:password',
            ],
            [ 
               'username.required' => 'User Name is required', 
            ]);    
        }
        else{
             $this->validate($request, [
            'username' => 'required|regex:/^[\pL\s\-]+$/u|max:30',
            'email' => 'required|string|email|max:255',
            ],
            [ 
               'username.required' => 'User Name is required', 
            ]);  
        }
        
        $userId = \Crypt::decrypt($id);
        $user = Admin::where('id', $userId)->first(); 
          
        if($user){
           $AdminProfile = AdminProfile::where('user_id', $userId)->first();
           $name = $request->get('username');
           $email = $request->get('email');
           $exits = Admin::whereNotIn('id', [1, $userId])->where('email',  $email)->count();
           if($exits > 0){
            return Redirect::back()->withErrors(['msg', 'Admin Email Already exits.Please try again !']);
           }else{
                $password = $request->get('password');
                if($password!=""){
                    $password = bcrypt($request->get('password'));
                }else{
                    $password = $user->password;
                }
                Admin::where([['id', '=', $userId]])->update(['name' => $name, 'email' => $email, 'google2fa_verify' => $request->twofa, 'password' => $password,'updated_at' => date('Y-m-d H:i:s',time())]);

            $AdminProfile->userlist = implode(',', (array) $request->get('userlist'));
            $AdminProfile->category = implode(',', (array) $request->get('category'));
            $AdminProfile->dashboard = implode(',', (array) $request->get('dashboard'));
            $AdminProfile->security =implode(',',(array) $request->get('security'));
            // $AdminProfile->adminwallet =implode(',',(array) $request->get('adminwallet'));
            $AdminProfile->withdrawwallet =implode(',',(array) $request->get('withdrawwallet'));
            $AdminProfile->depositlist =implode(',',(array) $request->get('depositlist'));
            $AdminProfile->coinsetting =implode(',',(array) $request->get('coinsetting'));
            // $AdminProfile->subscriber =implode(',',(array) $request->get('subscriber'));
            $AdminProfile->withdrawlist =implode(',',(array) $request->get('withdrawlist'));
            // $AdminProfile->tradehistory = implode(',', (array) $request->get('tradehistory'));
            // $AdminProfile->countries =implode(',',(array) $request->get('countries'));
            $AdminProfile->commissionsetting = implode(',', (array) $request->get('commissionsetting'));
            // $AdminProfile->kyc = implode(',', (array) $request->get('kyc'));
            // $AdminProfile->adminbank = implode(',', (array) $request->get('adminbank'));
            $AdminProfile->addadmin = implode(',', (array) $request->get('addadmin'));
            $AdminProfile->support = implode(',', (array) $request->get('support'));
            $AdminProfile->purchase = implode(',', (array) $request->get('purchase'));
            $AdminProfile->cms_settings = implode(',', (array) $request->get('cms'));

            // $AdminProfile->kyc_settings = implode(',', (array) $request->get('kyc_settings'));
            // $AdminProfile->contact = implode(',', (array) $request->get('contact'));
            // $AdminProfile->p2p = implode(',', (array) $request->get('p2p'));
            $AdminProfile->refferalcommission = implode(',', (array) $request->get('refferalcommission'));
            $AdminProfile->refferalhistory = implode(',', (array) $request->get('refferalhistory'));
            
            $AdminProfile->save();

                return Redirect::back()->with('message', 'Updated successfully!');
 
           }
           
           }         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {      
        $userId = \Crypt::decrypt($id);
        $user = Admin::where('id', $userId)->first();
        if($user){
            $user = Admin::where('id', $userId)->delete();
            Session::flash('success', "Deleted successfully!");  
            
        }
        else{
            Session::flash('error', "Some thing went wrong please try again later!"); 
       } 
        return Redirect::back();
    }

public function subadminsearch(Request $request)
    {
       $adminid = Session::get('adminId'); 
       $subadmin = AdminProfile::adminprofile(); 
        if(!in_array("read", explode(',',$subadmin->addadmin))){
          return redirect('admin/dashboard');  
        }     
       $limit=25;
      if(isset($_GET['page'])){
        $page = $_GET['page'];
        $i = (($limit * $page) - $limit)+1;
      }else{
        $i =1;
      }

      $adminid = \Session::get('adminId');
      $subadmin = AdminProfile::where(['user_id' => $adminid])->first();

    $newDate = date('Y-m-d', strtotime($request->fromdate));
    $newDate1 = date('Y-m-d', strtotime($request->todate));
    if($request->fromdate !="" && $request->todate !="")
    {
    $list = Admin::subadmin_date_search($newDate,$newDate1);
    }
    else{
    return redirect('admin/subadminlist')->with('searcherror', 'Start and End dates required!');
    }

    return view('adminaccount.subadminlist',['admins' => $list,'i' => $i,'subadmin' =>  $subadmin]);
    }
 
	public function subadminchangepassword($id)
    {
        $subadmin = AdminProfile::adminprofile(); 
        if(!in_array("read", explode(',',$subadmin->addadmin))  || !in_array("write", explode(',',$subadmin->addadmin)) ){
          return redirect('admin/dashboard');  
        }     
        
        $userId = \Crypt::decrypt($id);
        $user = Admin::where('id', $userId)->first(); 
       
        if(empty($user)){
           return redirect('admin/subadminlist'); 
        }
        $profile = AdminProfile::where('user_id', $userId)->first();
        return view('adminaccount.subadminpassedit',['user' => $user,'profile' => $profile,'id' => $id]);
    }



    public function subadminpassupdate(Request $request, $id)
    { 
        $userId = \Crypt::decrypt($id);
        $user = Admin::where('id', $userId)->first(); 
       
        if(empty($user)){
           return redirect('admin/subadminlist'); 
        }
         
         $this->validate($request, [
            'username' => 'required|regex:/^[\pL\s\-]+$/u|max:30',
            'email' => 'required|string|email|max:255',
            'password' =>'min:8|max:16|required_with:confirmpassword|same:confirmpassword|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'confirmpassword' => 'min:8|max:16|same:password',
            ],
            [ 
               'username.required' => 'User Name is required', 
            ]);    
        
        $userId = \Crypt::decrypt($id);
        $user = Admin::where('id', $userId)->first(); 
     
        if($user){
           $profile = AdminProfile::where('user_id', $userId)->first();
           $name = $request->get('username');
           $email = $request->get('email');
           $exits = Admin::whereNotIn('id', [1, $userId])->where('email',  $email)->count();
           if($exits > 0){
            return Redirect::back()->withErrors(['msg', 'Admin Email Already exits.Please try again !']);
           }else{
                $password = $request->get('password');
                if($password!=""){
                    $password = bcrypt($request->get('password'));
                }else{
                    $password = $user->password;
                }
               Admin::where([['id', '=', $userId]])->update(['name' => $name, 'email' => $email, 'password' => $password,'updated_at' => date('Y-m-d H:i:s',time())]);
                return Redirect::back()->with('message', 'Updated successfully!');
 
           }
           
           } 
    }

    public function changetwofaupdate(Request $request)
    { 
      
        $userId = \Session::get('adminId');
        $user = Admin::where('id', $userId)->first(); 
       
        if(empty($user)){
           return redirect('admin/subadminlist'); 
        }
        
        Admin::where('id',$userId)->update(['google2fa_verify' => $request->twofa,'updated_at' => date('Y-m-d H:i:s',time())]);
        return Redirect::back()->with('success', 'Updated successfully!');
           
    }

    public function resettwofa()
    { 
      
        $userId = \Session::get('adminId');
        $user = Admin::where('id', $userId)->first(); 
       
        if(empty($user)){
           return redirect('admin/subadminlist'); 
        }
        
        Admin::where('id',$userId)->update(['google2fa_verify' => 0,'google2fa_secret' => Null,'updated_at' => date('Y-m-d H:i:s',time())]);
        
        return redirect('admin/security')->with('success', 'Google 2FA Reset successfully!');
           
    }



}
