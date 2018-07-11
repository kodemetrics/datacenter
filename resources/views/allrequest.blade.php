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
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>For whom</th>
                                                <th>Reason</th>
                                                <th>Urgency</th>
                                                <th>Approval Status</th>
                                                <th>ID</th>
                                             </tr>
                                          </thead>

                                          <tbody>
                                              @foreach($data as $d)
                                                <tr>
                                                        <td>{{$d->created_at}}</td>
                                                        <td>{{$d->name}}</td>
                                                        <td>{{$d->whom}}</td>
                                                        <td>{{$d->reason}}</td>
                                                        <td>{{$d->urgency}}</td>
                                                        <td>{{$d->status}}</td>
                                                        <td>{{$d->id}}</td>
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