@extends('layouts.apps')

@section('content')

    <!-- Page-Title -->
    <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="active">
                                        Approve
                                    </li>
                                </ol>
                            </div>
                            <h4 class="page-title">Approve</h4>
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
                                   <div class="row">
                                       
                                     <form method="POST" class="col-sm-6">
                                         {{ csrf_field() }}
                                         <div class="form-group">
                                            <label>Approve</label>
                                             <select name="status" class="form-control" >
                                                 <option value="" disable>--choose--</option>
                                                 <option value="Approved">Yes</option>
                                                 <option value="Rejected">No</option>
                                             </select>
                                         </div>
                                         <div class="form-group">
                                            <label>Comments</label>
                                            <textarea name="comment" class="form-control" cols="30" rows="10"></textarea>
                                         </div>

                                         <input type="submit" value="submit" name="submit" class="btn btn-primary">
                                     
                                     </form>
                                     </div>
                          </div>
                     </div>
                </div>
                </div>
                <!-- end row -->

@endsection