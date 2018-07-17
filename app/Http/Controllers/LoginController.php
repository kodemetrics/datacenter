<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;

class LoginController extends Controller{

    use AuthenticatesUsers;
    //protected $redirectTo = '/dashboard';

    public function __construct(){

       // $this->middleware('auth2');
        //Session::flush();

      /*  User::create([
            'name' => 'Okafor Kingsley',
            'email' => 'kingsley.okafor@abujaelectricity.com',
            'password' => Hash::make('wilson'),
            'department' => 'ICT Facility & Infrastructure',
            'role_id' => 1,
        ]);*/
    }


    public function logout(){
          Session::flush();
          Auth::logout();
          return redirect('/');
      }


    public function index(Request $request){

        //$input = $request->all();
        $email = $request->email;
        $password = Hash::make($request->password);
        $data = User::where('email',$request->email)
                    ->where('password',$request->password)->get();
        
        if($data->count()){
          
            $request->session()->put('email', $data[0]['email']);
            $request->session()->put('name', $data[0]['name']);
            $request->session()->put('id', $data[0]['id']);
            //$request->session()->flush();

            return redirect('dashboard');

        }else{
            //return view('import_export');
            return response()->json('Failed');
        }  
    }


    protected function apiAuth(Request $request, $url = "https://pics.abujaelectricity.com/login/auth"){
       // $url = "https://pics.abujaelectricity.com/login/auth"
       // $url1 = "http://adservice.abujaelectricity.com/auth/detail";
       // $url2 = "http://adservice.abujaelectricity.com/auth/group";

        $fields_string = 'username='.$request->email.'&password='.$request->password;
        $password = $request->password;
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //execute post
        $result = curl_exec($ch);
        // dd($result);
        $result = json_decode($result, true);
        // dd($result);

        //close connection
        curl_close($ch);

        return $this->objectify($password,$result);
    }

    protected function objectify($password,$apiCallResult){
        
        //$obj = new \App\AuthCallResult();
        $msg = $apiCallResult['msg'];
        $status_code = $apiCallResult['status_code'];
        if(array_key_exists('data', $apiCallResult)){
            $data = User::where('email',$apiCallResult['data']['mail'])->get();
                if($status_code == 200){
                    if($data->count()==0 ){
                        $obj = new User;
                        $obj->role_id = 1;
                        $obj->staff_id = $apiCallResult['data']['staffnumber']= $apiCallResult['data']['staffnumber'] ?? 0;
                        $obj->name = $apiCallResult['data']['name'];
                        $obj->password = '';
                        $obj->phoneno = $apiCallResult['data']['mobile_phone']; 
                        $obj->email = $apiCallResult['data']['mail'];
                        $obj->job_title = $apiCallResult['data']['job_title'];
                        $obj->department = $apiCallResult['data']['department'];
                        $obj->isAdmin = 0;
                        $obj->save();

                        Session::put('id', $data[0]['id']);
                        Session::put('email', $apiCallResult['data']['mail']);
                        Session::put('name', $apiCallResult['data']['name']);

                       return redirect('dashboard')->with('message','Welcome..!');
                    }else{
                        Session::put('id', $data[0]['id']);
                        Session::put('email', $apiCallResult['data']['mail']);
                        Session::put('name', $apiCallResult['data']['name']);

                        return redirect('dashboard')->with('message','Welcome back');
                    }
                }else{
                    return redirect('/')->with('message','Invalid Login Credentials');
                } 
        }else{
                   return  redirect('/')->with('message','Invalid Login Credentials');
        }
        //method ends here
    }

}
