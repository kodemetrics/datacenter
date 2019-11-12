<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use App\User;
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


    public function username() {
        return "username";
    }

    protected function apiAuth($username, $password, $url){

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

      /*  $fields_string = "";
         if(strpos($request->email, '@abujaelectricity.com')){
           $fields_string .= 'username='.$request->email.'&password='.$request->password;
         }else{
            $fields_string .= 'username='.$request->email."@abujaelectricity.com".'&password='.$request->password;
         }

         */

        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //execute post
        $result = curl_exec($ch);
        // dd($result);
        $result = json_decode($result, true);
         //dd($result);
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


    protected function attemptLogin(Request $request) {

        //$authCallResult = $this->apiAuth($request->email, $request->password, $url = "https://pics.abujaelectricity.com/login/auth");
        $authCallResult = $this->apiAuth($request->email, $request->password, $url = "https://adservice.abujaelectricity.com/auth/detail"); 
       if (isset($authCallResult) and $authCallResult->status_code == "200") {
              $user = \App\User::where('email',$authCallResult->data->email) -> first();
              if($user==null ){
                  $authCallResult = $authCallResult->data;
                  $user = new \App\User();
                  $user->name = $authCallResult->name;
                  $user->email = $authCallResult->email;
                  $user->password = bcrypt($request->password);
                  $user->role_id = 1;
                  $user->phoneno = $authCallResult->mobile_phone;
                  $user->job_title = $authCallResult->job_title ?? '';
                  $user->isAdmin = 0;
                  $user->department = $authCallResult->department;
                 // $user->region = $authCallResult->region ?? 'HQ';
                  $user->save();
                  $request->session()->put('name', $authCallResult->name);
              }

          $result = $this->guard()->login($user, false);
          AuditLog::create(['username' => Auth::user()->name,'action' => 'Logged In','ipAddress' =>\Request::ip()]);
      }else{ return response()->json(['Login' => 'Failed Incorrect Username or Password']);  }

       return redirect()->back()->withInput();
    }

    protected function validateLogin(Request $request) {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function logout(){
        AuditLog::create(['username' => Auth::user()->name,'action' => 'Logged Out','ipAddress' =>\Request::ip()]);
        Session::flush();
        Auth::logout();
        return redirect('/');

    }
}
