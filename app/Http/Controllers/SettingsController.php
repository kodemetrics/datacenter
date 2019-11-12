<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Datacenter;
use App\Role;
use App\User;
use App\Requests;
use App\Approval;
use App\AuditLog;
use DB;
use Mail;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{
    public function __construct(){
       // $this->middleware('auth2');
       //$this->middleware('superadmin');
    }

    public function getSwiftMailer(){
        $transport = new \Swift_SmtpTransport(\Config::get('mail.host'), \Config::get('mail.port'), \Config::get('mail.encryption'));
        $transport->setStreamOptions(['ssl' => \Config::get('mail.ssloptions')]);
        $transport->setUsername(\Config::get('mail.username'));
        $transport->setPassword(\Config::get('mail.password'));
        
        $mailer = new \Swift_Mailer($transport);
        return $mailer;
    }

    public function showSettings(Request $request){
/*	try{Log::info("Email: Sending...");
	 $title = "Test";
         $content = "Test"; 	 
         Mail::send('test', ['title' => $title, 'content' => $content], function ($message)
         {
            $message->from('software.notice@abujaelectricity.com', 'Software Notice');
            $message->to('emem.isaac@abujaelectricity.com');
         });Log::info("Email: Sent!");
	}catch(\Exception $e){ Log::error("Email: " . $e); }

        return response()->json(['message' => 'Request completed']);*/


        $roles = Role::all();
        $datacenters = Datacenter::all();
        $users = User::all();
        $auditlog = AuditLog::all();
        //$approves = User::where('role_id',2)->get();
        $requests = Requests::onlyTrashed()->get();
        $approves =  DB::table('users')->join('roles', 'users.role_id', '=', 'roles.id')
                   ->whereIn('users.role_id', [2, 3])->select('users.*', 'roles.name as rolename')->get();

        return view('settings',compact('roles','datacenters','users','approves','requests','auditlog'));
        //return $approves;
     }

    public function addDatacenter(Request $request){
           $datacenter = new Datacenter;
           $datacenter->name = strtoupper($request->name);
           $datacenter->location = strtoupper($request->location);
           $datacenter->save();
           //$datacenter->save($request->all());
        return redirect()->back()->with('message','Added New Datacenter Succesfully');
     }
    public function addRoles(Request $request){
           $role = new role;
           $role->name = $request->name;
           $role->save();
           //$role->save($request->all());
           return redirect()->back()->with('message','Added New Role Succesfully');
     }
    public function addApprovingmgr(Request $request){
            User::where('email',$request->email)->update(['role_id'=>$request->role,'isAdmin'=>$request->isAdmin]);
        return redirect()->back()->with('message','Added New Approving Manager Succesfully');
     }

     public function deleteDatacenter(Request $request,$id){
         Datacenter::where('id',$id)->delete();
        return redirect()->back()->with('message','Deleted Succesfully');
     }
     public function deleteRoles(Request $request,$id){
         Role::where('id',$id)->delete();
        return redirect()->back()->with('message','Deleted Succesfully');
     }
     public function deleteApprovingmgr(Request $request,$id){
         Approval::where('id',$id)->delete();
        return redirect()->back()->with('message','Deleted Succesfully');
     }
     public function deleteTrash(Request $request,$id){
        // Requests::onlyTrashed()->where('id',$id)->restore();
         Requests::onlyTrashed()->where('id',$id)->forceDelete();
        return redirect()->back()->with('message','Deleted Succesfully');
     }


}
