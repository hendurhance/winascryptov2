<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>{{ $site_title }} - {{ $page_title }}{{--{{ $site_title .' - '. $page_title }}--}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- ASSETS -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/admin/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/admin/css/simple-line-icons.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/components-rounded.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{asset('assets/admin/css/plugins.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/layout.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/darkblue.min.css')}}" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="{{asset('assets/admin/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/datatables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/admin/css/datatables.bootstrap.css')}}"
          rel="stylesheet" type="text/css"/>
    <!-- END ASSETS -->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/userdashboard.css') }}">

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}"/>


    <style>
        .page-title{
            font-weight:bold;
            text-transform: uppercase;
        }
        td,th{
            font-weight: bold;
        }
    </style>
    @yield('style')

</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo user_dashboard">

<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">


        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{--{{  }}--}}">
                <img src="{!! asset('assets/images/logo.png') !!}" class="logo-default" alt="-"
                     style="filter: brightness(0) invert(1); width: 150px;height: 45px" />

            </a>

            <div class="menu-toggler sidebar-toggler"></div>
        </div>
        <!-- END LOGO -->


        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse"> </a>

        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">


                        <span class="username"> Welcome, {{ Auth::user()->name }} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">

                        <li><a href="{!! route('edit-profile') !!}"><i class="fa fa-edit"></i> Edit Profile </a></li>
                        <li><a href="{!! route('change-password') !!}"><i class="fa fa-cogs"></i> Change Password </a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- END HEADER -->


<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<div class="page-container">
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">


            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
                data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler"></div>
                </li>

                <li class="nav-item start">
                    <a href="{!! route('user-dashboard') !!}" class="nav-link ">
                        <i class="icon-home"></i><span class="title">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{!! route('investment-new') !!}" class="nav-link ">
                        <i class="fa fa-cloud-upload"></i><span class="title">New Investment</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{!! route('investment-history') !!}" class="nav-link ">
                        <i class="fa fa-history"></i><span class="title">Investment History</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{!! route('user-repeat-history') !!}" class="nav-link ">
                        <i class="fa fa-history"></i><span class="title">Repeat History</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{!! route('withdraw-request') !!}" class="nav-link ">
                        <i class="fa fa-money"></i><span class="title"> Withdraw Fund</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('withdraw-log') !!}" class="nav-link ">
                        <i class="fa fa-history"></i><span class="title"> Withdraw History</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{!! route('deposit-fund') !!}" class="nav-link ">
                        <i class="fa fa-money"></i><span class="title">Deposit Fund</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('deposit-history') !!}" class="nav-link ">
                        <i class="fa fa-history"></i><span class="title">Deposit History</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('reference-user') !!}" class="nav-link ">
                        <i class="fa fa-users"></i><span class="title">Reference User</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('user-activity') !!}" class="nav-link ">
                        <i class="fa fa-indent"></i><span class="title">Transaction Log</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{!! route('support-all') !!}" class="nav-link nav-toggle"><i class="fa fa-handshake-o"></i>
                        <span class="title">Get Support</span></a>
                </li>

            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
    </div>
    <!-- END SIDEBAR -->


    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper" >
        <div class="page-content">
            <h3 class="page-title">{!! $page_title  !!} </h3>
            <hr>


            <!--  ==================================VALIDATION ERRORS==================================  -->
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {!!  $error !!}
                    </div>
                @endforeach
            @endif
        <!--  ==================================SESSION MESSAGES==================================  -->

            @yield('content')


        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->


<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> <?php echo date("Y")?> All Copyright &copy; Reserved. </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->


<!-- BEGIN SCRIPTS -->
<script src="{{asset('assets/admin/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/bootstrap-hover-dropdown.min.js')}}"type="text/javascript"></script>
<script src="{{asset('assets/admin/js/jquery.slimscroll.min.js')}}"type="text/javascript"></script>
<script src="{{asset('assets/admin/js/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/app.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/layout.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/demo.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/quick-sidebar.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/datatables.bootstrap.js')}}"type="text/javascript"></script>
<script src="{{asset('assets/admin/js/table-datatables-buttons.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/js/sweetalert.min.js') }}"></script>
<script>
    @if (session()->has('message'))
        swal({
        title: "{!! session()->get('title')  !!}",
        text: "{!! session()->get('message')  !!}",
        type: "{!! session()->get('type')  !!}",
        confirmButtonText: "OK"
    });
    @php session()->forget('message') @endphp
    @endif

</script>

@yield('scripts')


</body>
</html>