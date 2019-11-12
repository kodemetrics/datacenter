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
                                      <!--  <div class="form-group">
                                            <label >Name</label>
                                            <input type="text" class="form-control" name="name" value="" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label >Email</label>
                                            <input type="email" class="form-control" name="email" value=""  placeholder="Enter email">
                                        </div> -->
                                        <div class="form-group">
                                            <label >For Whom</label>
                                            <select name="whom" class="form-control">
                                              <option  disable>{{$id->whom}}</option>
                                              <option>Self</option>
                                              <option>Vendor</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label >Urgency</label>
                                            <select name="urgency" class="form-control">
                                              <option disable>{{$id->urgency}}</option>
                                              <option>Low</option>
                                              <option>Medium</option>
                                              <option>High</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Reason</label>
                                            <textarea name="reason" class="form-control" rows="5">{{$id->reason}}</textarea>
                                        </div>

                                        <button type="submit" style="float:right" class="btn btn-purple waves-effect waves-light">Update</button>
                                    </form>
                                </div>

                                <div class="col-md-6 m-t-10">

                                </div>

                     </div>
                </div>
                <!-- end row -->

@endsection
