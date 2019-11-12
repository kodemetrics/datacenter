<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
use Carbon\Carbon;
use App\AuditLog;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'welcome']);
    }

    public function welcome(){
        return view('welcome');
    }

    function catchAll($errno, $errstr) {
        if(Session::has('flash_message')){
            $flash_message = Sesssion::get('flash_message');
        }
        Sesssion::flash('flash_message', $flash_message . ' ' . $errstr);
    }

    public function username() {
        return "username";
    }

    protected function apiAuth($username, $password, $url = "https://pics.abujaelectricity.com/login/auth"){

        $fields = array(
            'username' => urlencode($username),
            'password' => urlencode($password)
        );

        $fields_string = null;
        //url-ify the data for the POST
        foreach($fields as $key=>$value)
        {
            $fields_string .= $key.'='.$value.'&';
        }
        rtrim($fields_string, '&');

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        //dd($result);
        $result = json_decode($result, true);
        // dd($result);

        //close connection
        curl_close($ch);

        return $this->objectify($result);
    }

    //Objective API Call result
    protected function objectify($apiCallResult){
        $obj = new \App\AuthCallResult();
        $obj->msg = $apiCallResult['msg'];
        $obj->status_code = $apiCallResult['status_code'];
        if(array_key_exists('data', $apiCallResult)){
            $obj->data = new \App\ApiUserData();
            $obj->data->name = $apiCallResult['data']['name'];
            $obj->data->first_name = $apiCallResult['data']['firstname'];
            $obj->data->surname = $apiCallResult['data']['surname'];
            $obj->data->mobile_phone = $apiCallResult['data']['mobile_phone'];
            $obj->data->job_title = $apiCallResult['data']['job_title'];
            $obj->data->email = $apiCallResult['data']['mail'];
            $obj->data->department = $apiCallResult['data']['department'];
            $obj->data->region = $apiCallResult['data']['region'];
            try{
                $obj->data->yearResumed = $apiCallResult['data']['yearResumed'];
                $obj->data->monthResumed = $apiCallResult['data']['monthResumed'];
                $obj->data->dayResumed = $apiCallResult['data']['dayResumed'];
            }catch(\Exception $e){

            }
        }
        return $obj;
    }

    //This function uses both Sams API and Mine
    protected function attemptLogin(Request $request) {
        $username = $request->email;
        $password = $request->password;
        $name = "";
        Session::flash('first_login',"");
        if(strpos($username, "abujaelectricity") !== false){
            $parts = explode("@",$username);
            if(sizeOf($parts)>1){
                  $username = $parts[0];
            }
        }

        //------ EEmergency code ---
        // if($username){
        //     try
        //     {
        //         $user = \App\User::where('username', $username) -> first();
        //         if($user){
        //             $this->guard()->login($user, true);
        //             return redirect('/home');
        //         }
        //         else{
        //             $user = new \App\User();
        //             $name = explode(".",$username);
        //             if($name){
        //                 if(sizeof($name) == 1){
        //                     $user->first_name = ucfirst($name);
        //                 }
        //                 if(sizeOf($name)>1){
        //                     $user->first_name = ucfirst($name[0]);
        //                     $user->last_name = ucfirst($name[1]);
        //                 }
        //             }
        //             $user->name = $user->first_name . " " . $user->last_name;
        //             $user->username = $username;
        //             $user->password = bcrypt($username . $password);

        //             $user->save();
        //             $this->guard()->login($user, true);
        //             //Add me to admin role
        //             if(!$user->hasRole("admin")){
        //                 try{$user->roles()->attach(\App\Role::where('name', 'admin')->first());}catch(\Exception $e){}
        //             }
        //             return redirect('/home');
        //         }
        //     }
        //     catch(\Exception $dbs)
        //     {

        //     }
        // }
        // ----- end emergency code ---
        $authCallResult = null;
        try
        {
            //Dec 21, 2012 - Implemented auth fallback
            $urls = ["http://adservice.abujaelectricity.com/auth/detail", "https://pics.abujaelectricity.com/login/auth"];
            $authCallResult = null;
            for ($i=0; $i < sizeof($urls); $i++) {
                $url = $urls[$i];
                $authCallResult = $this->apiAuth($username, $password, $url);
                //dd($authCallResult);
                if($authCallResult->status_code == "200"){
                    break;
                }
            }
            if($authCallResult->status_code != "200")
            {
                $msg = "Invalid credentials, please double-check your username and password";
                if(isset($authCallResult->msg)){
                    $msg = $authCallResult->msg;
                }
                Session::flash("flash_message", "Invalid credentials, please double-check your username and password " . $authCallResult->msg);
                // return back()->withInput();
            }
            // dd($authCallResult);
        }
        catch(\Exception $e)
        {
            $user_message = $e->getMessage();
            // $user_message = "Unable to access authentication service. Please try again in a few minutes";
            Session::flash("flash_message", $user_message);
        }
        // dd($authCallResult);
        if (isset($authCallResult) and $authCallResult->status_code == "200") {
            $authCallResult = $authCallResult->data;
            //$user;


            $user = \App\User::where('email', $username.'@abujaelectricity.com') -> first();
           // dd($user);
            //if($user->count()==0 ){
            if($user==null ){
                $user = new \App\User();
                $user->name = $authCallResult->name;
                $user->email = $authCallResult->email;
                $user->password = bcrypt($password);
                $user->role_id = 1;
                $user->phoneno = $authCallResult->mobile_phone;
                $user->job_title = $authCallResult->job_title;
                $user->isAdmin = 0;
                $user->department = $authCallResult->department;
               // $user->region = $authCallResult->region;
                $user->save();
            }
            /*
            try
            {
                $user = \App\User::where('email', $username) -> first();
            }
            catch(\Exception $dbs)
            {
                Session::flash("flash_message", $dbs->getMessage());
                return redirect()->back()->withInput();
            }
            if ($user == null)
            {
                try
                {
                    //Doesn't have an account in the application, create it
                    $user = new \App\User();
                    $user->name = $authCallResult->name;
                    $user->email = $authCallResult->email;
                    $user->password = bcrypt($password);
                    $user->role_id = 1;
                    $user->staff_id = 1;
                    $user->phoneno = $authCallResult->mobile_phone;
                    $user->job_title = $authCallResult->job_title;
                    $user->isAdmin = 0;
                    $user->department = $authCallResult->department;
                   // $user->region = $authCallResult->region;
                    $user->save();
                }
                catch(\Exception $dbex)
                {
                    Session::flash("flash_message", $dbex->getMessage());
                }
            }
            else
            {
                //update user from AD
                $user->name = $authCallResult->name;
                $user->password = bcrypt($username . $password);
               // $user->first_name = $authCallResult->first_name;
                //$user->last_name = $authCallResult->surname;
                $user->department = $authCallResult->department;
                //$user->region = $authCallResult->region;
                $user->save();
            }*/
            AuditLog::create(['username' => $authCallResult->name,'action' => 'Logged in','ipAddress' =>\Request::ip()]);
            $result = $this->guard()->login($user, true);
           // return redirect('/dashboard');
        }

        //------ Fall back to local app auth ---
        // try{
        //     $user = \App\User::where('username', $username) -> first();
        //     $pwd = $username . $password;
        //     if(Auth::attempt(['username' => $username, 'password' => $pwd])){
        //         $this->guard()->login($user, true);
        //         return "true";
        //         return true;
        //     }
        //     else{
        //         $pwd = $username;
        //         if(Auth::attempt(['username' => $username, 'password' => $pwd])){
        //             $this->guard()->login($user, true);
        //             return "true";
        //             return true;
        //         }
        //     }
        //     Session::flash("flash_message", "Invalid credentials, please double-check your username and password.");
        // }catch(\Exception $ex){
        //     Session::flash("flash_message", $ex->getMessage());
        // }
        return redirect()->back()->withInput();
    }


    protected function validateLogin(Request $request) {
        $this->validate($request, [
            $this->username() => 'required|string',//|regex:/^\w+$/',
            'password' => 'required|string',
        ]);
    }

    public function logout(){
      Session::flush();
      Auth::logout();
        return redirect('/');

    }
}
