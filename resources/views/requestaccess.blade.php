@extends('layouts.apps')

@section('content')

    <!-- Page-Title -->
    <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="active">
                                        Make Request
                                    </li>
                                </ol>
                            </div>
                            <h4 class="page-title">Make Request</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-md-6 m-t-10">
                                    <form method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label >Name</label>
                                            <input type="text" class="form-control" name="name"  placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label >Email</label>
                                            <input type="email" class="form-control" name="email"  placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label >For Whom</label>
                                            <select name="whom" class="form-control">
                                              <option  disable>-- Choose --</option>
                                              <option>Self</option>
                                              <option>Vendor</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label >Urgency</label>
                                            <select name="urgency" class="form-control">
                                              <option disable>-- Choose --</option>
                                              <option>Low</option>
                                              <option>Medium</option>
                                              <option>High</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Reason</label>
                                            <textarea name="reason" class="form-control" rows="5"></textarea>
                                        </div>

                                        <button type="submit" style="float:right" class="btn btn-purple waves-effect waves-light">Submit</button>
                                    </form>
                                </div>

                                <div class="col-md-6 m-t-10">
                                     <table class="table bordered">
                                          <thead>
                                             <tr>
                                                <th>Date</th>
                                                <th>Reason</th>
                                                <th>Urgency</th>
                                                <th>Approval Status</th>
                                             </tr>
                                          </thead>

                                          <tbody>
                                              @foreach($data as $d)
                                                <tr>
                                                        <td>{{Carbon\Carbon::parse($d->created_at)->diffForHumans()}}</td>
                                                        <td>{{$d->reason}}</td>
                                                        <td>{{$d->urgency}}</td>
                                                        <td>{{$d->status}}</td>
                                                        <td><a href="{{ url('requestaccess/delete',[$d->id]) }}"><i class="mdi mdi-delete-forever mdi-24 "></i></a></td>
                                                </tr>  
                                                @endforeach
                                          </tbody>
                                     </table>
                                </div>    

                     </div>
                </div>
                <!-- end row -->

@endsection