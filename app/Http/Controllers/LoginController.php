<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller{


    public function __construct(){

        $this->middleware('guest');

      /*  User::create([
            'name' => 'Okafor Kingsley',
            'email' => 'kingsley.okafor@abujaelectricity.com',
            'password' => Hash::make('wilson'),
            'department' => 'ICT Facility & Infrastructure',
            'role_id' => 1,
        ]);*/
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
}
