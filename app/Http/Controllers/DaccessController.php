<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\User;
use App\Requests;
use Mail;
use Session;

class DaccessController extends Controller
{
    public function index(Request $request){
        
    }

    public function showDasboard(Request $request){
        return view('dashboard');
    }

    public function showRequestaccess(Request $request){
            $data = Requests::where('user_id',Session::get('id'))->get();
           return view('requestaccess',compact('data'));
    }

    public function showAllrequest(Request $request){

           $data = Requests::all();
           return view('allrequest',compact('data'));
       }

    public function showSettings(Request $request){

          // $data = Requests::all();
           return view('settings');
       }

    public function deleterequest(Request $request,$id){

          Requests::where('id',$id)->delete();
          return redirect('requestaccess');
       }
       
    public function storeRequestaccess(Request $request){
              
      /*$nerd = new Requests;
        $nerd->user_id  = Session::get('id');
        $nerd->name  = $request->name;
        $nerd->email = $request->email;
        $nerd->whom = $request->whom;
        $nerd->reason = $request->reason;
        $nerd->urgency  = $request->urgency;
        //$nerd->comment  = $request->comment= $request->comment ?? '';
        $nerd->approvemgr  = $request->approvemgr= $request->approvemgr ?? '';
        $nerd->status = $request->status = $request->status ?? 'Pending';
        $nerd->save();*/

        $data = User::all();
        $emailsTo = [];
        $emailsLen = count($data);
        for($i = 0; $i< $emailsLen; $i++){
            array_push($emailsTo,$data[$i]['email']);
        }
        dd($emailsTo);
    
        /*  Mail::send('mail', compact('data') , function($message) use($emailsTo) {
            $message->to($emailsTo,'')->subject('Transfer Request');
            $message->from('kingsley.okafor@hampocgroup.com','');
        }); */
        
         return redirect()->back();
       }


}
