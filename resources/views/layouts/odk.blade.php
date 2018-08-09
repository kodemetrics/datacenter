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
        <style>
       /*Now the CSS*/
* {margin: 0; padding: 0;}

.tree ul {
	padding-top: 20px; position: relative;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

.tree li {
	float: left; text-align: center;
	list-style-type: none;
	position: relative;
	padding: 20px 5px 0 5px;
    font-size:18px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
	content: '';
	position: absolute; top: 0; right: 50%;
	border-top: 1px solid #ccc;
	width: 50%; height: 20px;
}
.tree li::after{
	right: auto; left: 50%;
	border-left: 1px solid #ccc;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
	display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
	border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
	border-right: 1px solid #ccc;
	border-radius: 0 5px 0 0;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
	border-radius: 5px 0 0 0;
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before{
	content: '';
	position: absolute; top: 0; left: 50%;
	border-left: 1px solid #ccc;
	width: 0; height: 20px;
}

.tree li a{
    
	border: 1px solid #ccc;
	padding: 5px 10px;
	text-decoration: none;
	color: #666;
    background-color:#ccc;
	font-family: arial, verdana, tahoma;
	font-size: 11px;
	display: inline-block;
    
	
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also
.tree li a:hover, .tree li a:hover+ul li a {
	background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
}*/
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
	border-color:  #94a0b4;
}
.sub{
    position:relative;
    background-image: url("assets/images/sub.jpg");
    width:100%;
    height:450px;
}
/*Thats all. I hope you enjoyed it.
Thanks :)*/

.flat-icon{
    background-image: url("assets/images/capture023.png") ;
    background-repeat: no-repeat;
    background-position: center center;
    background-color:transparent;
    display:inline;
    width:39px;
    height:150px;
    padding:5px;
}

.tree li a.flat-icon {
    border: none;
    padding: 5px 10px;
    text-decoration: none;
    color: #666;
    background-color:transparent;
    font-family: arial, verdana, tahoma;
    font-size: 11px;
    display: inline-block;
    }

 .tree li a.rm,
 .tree li a.in,
 .tree li a.cable-feeder,
 .tree li a.incoming33kv-feeder
  {
    background-image: url("assets/images/capture01.png") ;
    background-repeat: no-repeat;
    background-position: center center;
    background-color:transparent;
    display:inline;
    width:100px;
    height:120px;
    padding:5px;
    border: none;
    padding: 5px 10px;
    text-decoration: none;
    color: #666;
    background-color:transparent;
    font-family: arial, verdana, tahoma;
    font-size: 14px;
    font-weight:bold;
    display: inline-block;
    }
 .tree li a.value
  {
    background-color:transparent;
    display:inline;
    width:100px;
    height:120px;
    padding:5px;
    border: none;
    padding: 5px 10px;
    text-decoration: none;
    color: #666;
    background-color:transparent;
    font-family: arial, verdana, tahoma;
    font-size: 14px;
    font-weight:bold;
    display: inline-block;
    }
    .tree li a.in{
        background-image: url("assets/images/capture024.png") ;
        width:204px;
        height:223px;
    }
    .tree li a.cable-feeder{
        background-image: url("assets/images/capture025.png") ;
        width:468px;
        height:51px;
    }
    .tree li a.incoming33kv-feeder{
        background-image: url("assets/images/capture026.png") ;
        width:auto;
        height:176px;
    }
    body{
        zoom: 100%;
    }
    </style>

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
                          <!-- <b style="font-size:28px;font-weight:bold;">AEDC</b>-->
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
                                        <h5>Hi, {{Session::get('name')}}</h5>
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

                           <!-- <li class="has-submenu">
                                <a href="{{ url('requestaccess') }}"><i class="mdi mdi-google-pages"></i>Make Request</a>
                            </li>

                            <li class="has-submenu">
                                <a href="{{ url('allrequest') }}"><i class="mdi mdi-comment-text"></i> All Request</a>
                            </li>


                            <li class="has-submenu">
                                <a href="{{ url('settings') }}"><i class="mdi mdi mdi-settings "></i>Settings</a>
                            </li>
                            -->

                      
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
                              <!--  © <?php echo date('Y') ?> Abuja Electricity Distribution Company -->
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div>
        </div>



        <!-- jQuery  -->
        <script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
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