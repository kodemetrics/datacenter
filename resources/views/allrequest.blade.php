@extends('layouts.apps')

@section('content')

    <!-- Page-Title -->
    <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="active">
                                        All Request
                                    </li>
                                </ol>
                            </div>
                            <h4 class="page-title">All Request</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">

                                     <table class="table bordered">
                                          <thead>
                                             <tr>

                                                <th width="5%">Name</th>
                                                <th>For whom</th>
                                                <th width="23%">Reason</th>
                                                <th>Priority</th>
                                                <th>Supervisor name</th>
                                                <th>Datacenter</th>
                                                <th>Approval Mgr</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                             </tr>
                                          </thead>

                                          <tbody>
                                              @foreach($data as $d)
                                                <tr>

                                                        <td>{{$d->name}}</td>
                                                        <td>
                                                          <div  data-toggle="tooltip" data-placement="left"
                                                            data-html="true" title="<p>{{$d->vname}}</p><p>{{$d->vorg}}</p><p>{{$d->vmobileno}}</p>">{{$d->whom}}
                                                          </div>
                                                        </td>
                                                        <td>{{$d->reason}}</td>
                                                        <td><span class="label label-{{strtolower($d->urgency)}}">{{$d->urgency}}</span></td>
                                                        <td>{{$d->sname}}</td>
                                                        <td>{{$d->dcenter}}</td>
                                                        <td>{{$d->approvemgr}}</td>
                                                            @if(($user->role_id == 3) && ($d->status=='Pending'))
                                                            <td> 
                                                                <a href="{{url('requestaccess/approve/'.$d->id)}}">
                                                                 <span class="label label-inverse">{{$d->status}}</span
                                                                </a>
                                                            </td>
                                                            @elseif( ($d->status=='Rejected') || ($d->status=='Denied')   )
                                                               <td><span class="label label-danger">{{$d->status}}</span></td>
                                                            @else
                                                               <td>{{$d->status}}</td>
                                                            @endif

                                                          <td>{{$d->created_at}}</td>


                                                </tr>
                                                @endforeach
                                          </tbody>
                                     </table>

                          </div>
                     </div>

                </div>
                </div>
                <!-- end row -->

@endsection
