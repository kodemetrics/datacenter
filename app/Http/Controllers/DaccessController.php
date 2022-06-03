<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Datacenter;
use App\Vendor;
use App\User;
use App\Requests;
use App\Role;
use Mail;
use Session;
use App\AuditLog;

class DaccessController extends Controller
{

    public function __construct(){

             //$this->middleware('auth2');
             $this->middleware('approve', ['only' => ['approveRequest', 'storeApprove']]);
     }

    public function index(Request $request){

    }


    public function showDasboard(Request $request){
        $all = Requests::all()->count();
        $today = Requests::whereDate('created_at',date("Y-m-d"))->count();
        $month = Requests::whereYear('created_at',date("Y"))->whereMonth('created_at',date("m"))->count();

        $allApproved = Requests::all()->where('status','Approved')->count();
        $todayApproved = Requests::where('status','Approved')->whereDate('created_at',date("Y-m-d"))->count();
        $monthApproved = Requests::where('status','Approved')->whereYear('created_at',date("Y"))->whereMonth('created_at',date("m"))->count();

        $data = array(
            'all'=> $all,'today'=> $today,'month'=> $month,
            'allA'=> $allApproved,'todayA'=> $todayApproved,'monthA'=> $monthApproved
          );

        return view('dashboard',compact('data'));
    }

    public function showRequestaccess(Request $request){
            $data = Requests::where('user_id',Auth::id())->get();
            $datacenter = Datacenter::all();
            $users = User::all();
           return view('requestaccess',compact('data','datacenter','users'));
    }

    public function showAllrequest(Request $request){
           //$data = Requests::with('user')->select('requests.*')->get();
           $data = \DB::table('users')
                         ->join('requests', 'users.id', '=', 'requests.user_id')
                         ->leftjoin('vendors', 'requests.id', '=', 'vendors.requests_id')
                         ->select('requests.*','vendors.vname','vendors.vorg','vendors.vmobileno', 'users.name as name','users.email as email')
                         ->orderBy('created_at', 'desc')
                         ->whereNull('deleted_at')
                         ->get();

           return view('allrequest',compact('data'));
       }

    public function editRequest(Requests  $id){
          return view('editrequest',compact('id'));
       }


    public function approveRequest(Request $request, $id){
              $data = Requests::with('user')->where('id',$id)->get();
          return view('approverequest',compact('data'));
       }

    public function storeApprove(Request $request, $id){
          $request->validate(['status' => 'required','comment' => 'required',
                          'email' => 'required']);
          $users = User::where('email',$request->email)->first();
          $data = Requests::where('id',$id)->update([
              'status'=>$request->status,
              'approvemgr'=>Auth::user()->name,
              'comment'=>$request->comment,
              'assignto'=>$users->name
              ]);

         AuditLog::create(['username' => Auth::user()->name,'action' => 'Update','ipAddress' =>\Request::ip()]);
         return redirect('/allrequest')->with('message','Done');
       }

    public function updateRequest(Request $request,$id){

          Requests::where('id',$id)->update(['whom'=>$request->whom,
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
	Log::info("Email - just entered storeRequestAccess function expect a mail soon");
        $request->validate([
            'id' => 'required',
            'whom' => 'required',
            'reason' => 'required',
            'urgency' => 'required',
            'dcenter' => 'required',
            'awareness' => 'required'
        ]);

        $users = User::where('email',$request->sname)->first();

        $nerd = new Requests;
        $nerd->user_id  = Session::get('id') ?: Auth::id();
        $nerd->id  = $request->id;
        $nerd->whom = $request->whom;
        $nerd->reason = $request->reason;
        $nerd->urgency  = $request->urgency;
        $nerd->dcenter  = $request->dcenter;
        $nerd->awareness  = $request->awareness;
        $nerd->sname  = $users->name;
        $nerd->assignto  = $request->assignto = $request->assignto ?? '';
        $nerd->comment  = $request->comment= $request->comment ?? '';
        $nerd->approvemgr  = $request->approvemgr= $request->approvemgr ?? '';
        $nerd->status = $request->status = $request->status ?? 'Pending';
        $nerd->save();

        if($request->whom =="Vendor"){
              $request->validate([
                  'vname' => 'required','vorg' => 'required','vmobileno' => 'required'
              ]);

              $vendor = Vendor::create([
                'requests_id' =>  $request->id,
                'vname' =>  $request->vname,
                'vorg' =>  $request->vorg,
                'vmobileno' =>  $request->vmobileno
              ]);
          }


          $data = \DB::table('users')
                        ->join('requests', 'users.id', '=', 'requests.user_id')
                        ->leftjoin('vendors', 'requests.id', '=', 'vendors.requests_id')
                        ->select('requests.*','vendors.vname','vendors.vorg','vendors.vmobileno', 'users.name as name','users.email as email')
                        ->where('requests.id',$request->id)
                        ->first();

    
          AuditLog::create(['username' => Auth::user()->name,'action' => 'Create','ipAddress' =>\Request::ip()]);
          return redirect()->back()->with('message','Created Sucessfully ' . $err);
       }


}
