@extends('layouts.apps')

@section('content')

    <!-- Page-Title -->
    <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="active">
                                        Show Request
                                    </li>
                                </ol>
                            </div>
                            <h4 class="page-title">Show Request</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->
                <div class="col-sm-12">
                        <div class="card-box">
                            <h4 class="m-t-0 header-title"><b>Sweet-Alert Examples</b></h4>
                            <p class="text-muted m-b-30 font-13">
                                A beautiful replacement for JavaScript's "Alert".
                            </p>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="min-width:50%;">Alert Type</th>
                                        <th>Example</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="middle-align">Basic Example</td>
                                        <td>
                                            <button class="btn btn-default waves-effect waves-light btn-sm" id="sa-basic">Click me</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="middle-align">A title with a text under</td>
                                        <td>
                                            <button class="btn btn-default waves-effect waves-light btn-sm" id="sa-title">Click me</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="middle-align">A success message!</td>
                                        <td>
                                            <button class="btn btn-default waves-effect waves-light btn-sm" id="sa-success">Click me</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="middle-align">A warning message, with a function attached to the "Confirm"-button...</td>
                                        <td>
                                            <button class="btn btn-default waves-effect waves-light btn-sm" id="sa-warning">Click me</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="middle-align">By passing a parameter, you can execute something else for "Cancel".</td>
                                        <td>
                                            <button class="btn btn-default waves-effect waves-light btn-sm" id="sa-params">Click me</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="middle-align">A message with custom Image Header</td>
                                        <td>
                                            <button class="btn btn-default waves-effect waves-light btn-sm" id="sa-image">Click me</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="middle-align">A message with auto close timer</td>
                                        <td>
                                            <button class="btn btn-default waves-effect waves-light btn-sm" id="sa-close">Click me</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="middle-align">A message with button primary</td>
                                        <td>
                                            <button class="btn btn-primary waves-effect waves-light btn-sm" id="primary-alert">Click me</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="middle-align">A message with button info</td>
                                        <td>
                                            <button class="btn btn-info waves-effect waves-light btn-sm" id="info-alert">Click me</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="middle-align">A message with button success</td>
                                        <td>
                                            <button class="btn btn-success waves-effect waves-light btn-sm" id="success-alert">Click me</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="middle-align">A message with button warning</td>
                                        <td>
                                            <button class="btn btn-warning waves-effect waves-light btn-sm" id="warning-alert">Click me</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="middle-align">A message with button danger</td>
                                        <td>
                                            <button class="btn btn-danger waves-effect waves-light btn-sm" id="danger-alert">Click me</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end card-box -->
                    </div> 
                </div>
                <!-- end row -->

@endsection