@extends('layouts.apps')

@section('content')

    <!-- Page-Title -->
    <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="active">
                                       Settings
                                    </li>
                                </ol>
                            </div>
                            <h4 class="page-title">Settings</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


                <div class="row">
                    <div class="col-sm-8">
                        <div class="card-box">
                                
                        <h4 class="header-title m-t-0 m-b-30">Admin Only</h4>

                            <ul class="nav nav-tabs tabs-bordered">
                                <li class="active">
                                    <a href="#home-b1" data-toggle="tab" aria-expanded="true">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">DataCenters</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#profile-b1" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                                        <span class="hidden-xs">Email/Permission</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#messages-b1" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                        <span class="hidden-xs">Roles</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#settings-b1" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                        <span class="hidden-xs">Trashed Request</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane" id="home-b1">
                                   
                                      <form class="m-b-10" method="POST" action="/settings/adddatacenter">
                                           {{ csrf_field() }}
                                         <div class="form-group">
                                             <label for="">Name</label>
                                             <input type="text" name="name" class="form-control">
                                         </div>
                                         <div class="form-group">
                                             <label for="">Location</label>
                                             <input type="text" name="location" class="form-control">
                                         </div>
                                         <div class="form-group">
                                         <button type="submit" style="float:right" class="btn btn-purple">Update</button>
                                         </div>
                                      </form>

                                      <table class="table">
                                      <thead>
                                           <tr>
                                                  <th>ID</th>
                                                  <th>Name</th>
                                                  <th>Location</th>
                                           </tr>
                                      </thead>
                                      <tbody>
                                            @foreach($datacenters as $datacenter)
                                                <tr>
                                                    <td>{{$datacenter->id}}</td>
                                                    <td>{{$datacenter->name}}</td>
                                                    <td>{{$datacenter->location}}</td>
                                                    <td><a href="{{ url('settings/adddatacenter/delete',[$datacenter->id]) }}"><i class="mdi mdi-delete-forever mdi-24 "></i></a></td>
                                                </tr>
                                            @endforeach
                                      </tbody>
                                      </table>
                                     
                                </div>
                                
                                <div class="tab-pane" id="profile-b1">
                                    <form method="Post" action="/settings/addapprovingmgr">
                                             {{ csrf_field() }}
                                        <div class="form-group">
                                           <label>Name</label>
                                            <select name="email" class="form-control">
                                                 @foreach($users as $user)
                                                   <option value="{{$user->email}}">{{$user->name}}</option>
                                                 @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                                <label>Role</label>
                                                <select name="role" class="form-control">
                                                  <option selected disabled>--Choose--</option>
                                                @foreach($roles as $role)
                                                   <option value="{{$role->id}}">{{$role->name}}</option>
                                                 @endforeach
                                            </select>
                                        </div>

                                        <div  class="form-group">
                                               <label>IsAdmin</label>
                                               <select name="isAdmin" class="form-control">
                                                   <option selected disabled>--Choose--</option>
                                                   <option value="1">Yes</option>
                                                   <option value="0">No</option>
                                               </select>
                                        </div>

                                        <div class="form-group">
                                            <input style="float:right" type="submit" value="submit" class="btn btn-primary"/>
                                        </div>
                                    </form>
                                        <table class="table">
                                                <thead>
                                                    <tr>
                                                            <th>ID</th>
                                                            <th>RoleID</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                    </tr>
                                                </thead>
                                               <tbody>
                                                    @foreach($approves as $approve)
                                                            <tr>
                                                                <td>{{$approve->id}}</td>
                                                                <td>{{$approve->rolename}}</td>
                                                                <td>{{$approve->name}}</td>
                                                                <td>{{$approve->email}}</td>
                                                                <td><a href="{{ url('settings/addapprovingmgr/delete',[$approve->id]) }}"><i class="mdi mdi-delete-forever mdi-24 "></i></a></td>
                                                            </tr>
                                                        @endforeach
                                                </tbody>
                                        </table>
                                </div>

                                <div class="tab-pane active" id="messages-b1">
                                    <form method="Post" action="/settings/addrole" >
                                            {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <input style="float:right" type="submit" value="submit" class="btn btn-primary"/>
                                        </div>
                                    </form>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($roles as $role)
                                                <tr>
                                                    <td>{{$role->id}}</td>
                                                    <td>{{$role->name}}</td>
                                                    <td><!--<a href="{{ url('settings/addrole/delete',[$role->id]) }}"><i class="mdi mdi-delete-forever mdi-24 "></i></a>--></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                      </table>
                                </div>
                          
                                <div class="tab-pane" id="settings-b1">
                                    <table class="table">
                                       <thead>
                                         <tr>
                                             <th>Created Date</th>
                                             <th>Trashed Date</th>
                                             <th>Name</th>
                                             <th>Whom</th>
                                             <th>Reason</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                         @foreach($requests as $request)
                                          <tr>
                                             <td>{{Carbon\Carbon::parse($request->created_at)->diffForHumans()}}</td>
                                             <td>{{Carbon\Carbon::parse($request->deleted_at)->diffForHumans()}}</td>
                                             <td>{{$request->name}}</td>
                                             <td>{{$request->whom}}</td>
                                             <td>{{$request->reason}}</td>
                                             <td><a href="{{ url('settings/trash/delete',[$request->id]) }}"><i class="mdi mdi-delete-forever mdi-24 "></i></a></td>
                                          </tr>
                                          @endforeach
                                       </tbody>
                                    </table>
                                </div>
                            </div>

                           
                        </div>
                    </div>
                </div>
                <!-- end row -->

@endsection