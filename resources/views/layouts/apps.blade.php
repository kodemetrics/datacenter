<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        -->

        <title>AEDC - Date Center Access Control</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="{{ URL::asset('plugins/morris/morris.css')}}">
        <link href="{{ URL::asset('plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css">

        <!-- App css -->
        <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/css/core.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/css/components.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/css/menu.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{ URL::asset('plugins/switchery/switchery.min.css')}}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="{{ URL::asset('assets/js/modernizr.min.js')}}"></script>

    </head>


    <body>


        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- Logo container-->
                    <div class="logo">
                        <!-- Text Logo -->
                        <!--<a href="index.html" class="logo">-->
                            <!--Zircos-->
                        <!--</a>-->
                        <!-- Image Logo -->
                        <a href="{{ url('dashboard') }}" class="logo">
                            <img src="assets/images/logo.png" alt="" height="30">
                           <!--<b style="font-size:28px;font-weight:bold;">AEDC</b>-->
                        </a>

                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras">

                        <ul class="nav navbar-nav navbar-right pull-right">
                          <!--  <li class="navbar-c-items">
                                <form role="search" class="navbar-left app-search pull-left hidden-xs">
                                     <input type="text" placeholder="Search..." class="form-control">
                                     <a href=""><i class="fa fa-search"></i></a>
                                </form>
                            </li>-->

                            <li class="dropdown navbar-c-items">
                                <a href="" class="dropdown-toggle waves-effect waves-light profile" data-toggle="dropdown" aria-expanded="true"><i class="ti ti-user  mdi-18"></i><!--<img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle">--> </a>
                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                    <li class="text-center">
                                        <h5>Hi, {{Auth::user()->name}}</h5>
                                    </li>
                                      <li><a href="{{ url('/logout') }}"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                </ul>

                            </li>
                        </ul>
                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>
                    <!-- end menu-extras -->

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li class="has-submenu">
                                <a href="{{ url('dashboard') }}"><i class="mdi mdi-view-dashboard"></i>Dashboard</a>
                            </li>

                            <li class="has-submenu">
                                <a href="{{ url('requestaccess') }}"><i class="mdi mdi-google-pages"></i>Make Request</a>
                            </li>

                            <li class="has-submenu">
                                <a href="{{ url('allrequest') }}"><i class="mdi mdi-comment-text"></i> All Request</a>
                            </li>

                           @if(Auth::user()->isAdmin ==1)
                                <li class="has-submenu">
                                    <a href="{{ url('settings') }}"><i class="mdi mdi mdi-settings "></i>Settings</a>
                                </li>
                           @endif


                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->


        <div class="wrapper">
                <div class="container">
                       <!-- @if(Session::has('message'))
                            <div class="alert alert-success alert-icon alert-dismissible ">
                                <div class="message">
                                    <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                                    <span aria-hidden="true" class="mdi mdi-close"></span></button>
                                    <strong>{{ Session::get('message') }}</strong>
                                </div>
                            </div>
                        @endif-->

                    @yield('content')
                </div>
        </div>


                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                © <?php echo date('Y') ?> Abuja Electricity Distribution Company
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div>
        </div>



        <!-- jQuery  -->
        <script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/index.js')}}"></script>
        <script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/detect.js')}}"></script>
        <script src="{{ URL::asset('assets/js/fastclick.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{ URL::asset('assets/js/waves.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.scrollTo.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/switchery/switchery.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
       <!-- <script src="{{ URL::asset('assets/pages/jquery.sweet-alert.init.js')}}"></script>-->
        <!-- Counter js  -->
        <script src="{{ URL::asset('/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
        <script src="{{ URL::asset('/plugins/counterup/jquery.counterup.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

        <!--Morris Chart
		<script src="{{ URL::asset('/plugins/morris/morris.min.js')}}"></script>
		<script src="{{ URL::asset('/plugins/raphael/raphael-min.js')}}"></script> -->

        <!-- Dashboard init
        <script src="{{ URL::asset('assets/pages/jquery.dashboard.js')}}"></script> -->

        <!-- App js -->
        <script src="{{ URL::asset('js/growl.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.core.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.app.js')}}"></script>
        <script>
                var value = "{{ Session::get('message') }}";
                    if(!!value){
                       //$.notify( value,"success");
                        toastr.info(value,'');
                       //alert(value);
                    }
        </script>

    </body>
</html>
