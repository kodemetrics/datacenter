<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Datacenter;
use App\User;
use App\Requests;
use Mail;
use Session;

class DaccessController extends Controller
{

    public function __construct(){

             $this->middleware('auth2');
     }

    public function index(Request $request){
        
    }

    public function showDasboard(Request $request){
        $all = Requests::all()->count();
        $today = Requests::whereDate('created_at',date("Y-m-d"))->count();
        $month = Requests::whereYear('created_at',date("Y"))->whereMonth('created_at',date("m"))->count();

        $data = array(
            'all'=> $all,'today'=> $today,'month'=> $month
          );

        return view('dashboard',compact('data'));
       // return User::find(1)->requests;
       // return  $task = Requests::with('user')->where('id', 1)->get();
        //return Requests::find(2)->user;
    }

    public function showRequestaccess(Request $request){
            $data = Requests::where('user_id',Session::get('id'))->get();
            $datacenter = Datacenter::all();
           return view('requestaccess',compact('data','datacenter'));
    }

    public function showAllrequest(Request $request){

           $data = Requests::all();
           return view('allrequest',compact('data'));
       }


    public function editRequest(Requests $id){
          //$id = Requests::where('id',$id)->get();
          return view('editrequest',compact('id'));
       }
    public function approveRequest(Request $request, $id){
          $data = Requests::where('rx',$id)->get();
          return view('approverequest',compact('data'));
       }

    public function storeApprove(Request $request, $id){
          $data = Requests::where('rx',$id)->update([
              'status'=>$request->status,
              'approvemgr'=>Session::get('name'),
              'comment'=>$request->comment
              ]);
              //dd($request->status);
             // Mail::send('mail', compact('data') , function($message) use($emailsTo,$emailsCC,$emailsFrom,$emailsName ) {
              //  $message->to($emailsTo,'')->cc($emailsCC)->subject('Transfer Request');
              //  $message->from($emailsFrom,$emailsName);
          return redirect()->back()->with('message','Done');
       }

    public function updateRequest(Request $request,$id){

          Requests::where('id',$id)->update(['name'=>$request->name,
                                             'email'=>$request->email,
                                             'whom'=>$request->whom,
                                             'urgency'=>$request->urgency,
                                             'reason'=>$request->reason]);
          return redirect('requestaccess')->with('message','Updated Sucessfully');
       }

    public function deleteRequest(Request $request,$id){

         $delete =  Requests::where('id',$id)->where('status','Pending')->delete();
           if($delete){
              return redirect('requestaccess')->with('message','Deleted Sucessfully');
           }else{
            return redirect('requestaccess')->with('message','Cannot Delete Already Approved Request');
           }
       }
       
    public function storeRequestaccess(Request $request){
        $request->validate([
            'name' => 'required',
            'rx' => 'required',
            'email' => 'required',
            'whom' => 'required',
            'reason' => 'required',
            'urgency' => 'required',
            'dcenter' => 'required',
        ]);      
        $nerd = new Requests;
        $nerd->user_id  = Session::get('id');
        $nerd->name  = $request->name;
        $nerd->rx  = $request->rx;
        $nerd->email = $request->email;
        $nerd->whom = $request->whom;
        $nerd->reason = $request->reason;
        $nerd->urgency  = $request->urgency;
        $nerd->dcenter  = $request->dcenter;
        $nerd->comment  = $request->comment= $request->comment ?? '';
        $nerd->approvemgr  = $request->approvemgr= $request->approvemgr ?? '';
        $nerd->status = $request->status = $request->status ?? 'Pending';
        $nerd->save();
      
        $data = array(
            'name'=> $request->name,'email'=> $request->email,
            'whom'=> $request->whom,'reason'=> $request->reason,
            'dcenter'=>$request->dcenter,'urgency'=>$request->urgency,
            'url'=> "http://localhost:8000/requestaccess/approve/".$request->rx,
          );

                $To = User::where('role_id',3)->get();
                $emailsTo = [];
                $emailsLen = count($To);
                for($i = 0; $i< $emailsLen; $i++){
                    array_push($emailsTo,$To[$i]['email']);
                }
                
                $emailsCC = [];
                $Cc = User::where('role_id',2)->get();
                foreach($Cc as $Cc){
                    array_push($emailsCC,$Cc->email);
                }
                
                $emailsFrom = $request->email;
                $emailsName = $request->name;

               
            Mail::send('mail', compact('data') , function($message) use($emailsTo,$emailsCC,$emailsFrom,$emailsName ) {
            $message->to($emailsTo,'')->cc($emailsCC)->subject('Datacenter Access Request');
            $message->from($emailsFrom,$emailsName);
        });
        
         return redirect()->back()->with('message','Created Sucessfully');
       }


}
