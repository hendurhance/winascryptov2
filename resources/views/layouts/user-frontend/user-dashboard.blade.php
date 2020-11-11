<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $site_title }} | {{ $page_title }}</title>
    <!--Favicon add-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo/icon.png') }}">
    <!--bootstrap Css-->
    <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--font-awesome Css-->
    <link href="{{ asset('assets/front/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Lightcase  Css-->
    <link href="{{ asset('assets/front/css/lightcase.css') }}" rel="stylesheet">
    <!--Slick Slider Css-->
    <link href="{{ asset('assets/front/css/slick.css') }}" rel="stylesheet">
    <!--Slick Nav Css-->
    <link href="{{ asset('assets/front/css/slicknav.min.css') }}" rel="stylesheet">
    <!--Swiper  Css-->
    <link href="{{ asset('assets/front/css/swiper.min.css') }}" rel="stylesheet">
    <!--Style Css-->
    <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet">
    <!-- Theam Color Css-->
    <link href="{{ asset('assets/css/color.php?color='.$basic->color) }}" rel="stylesheet">
    <!--Responsive Css-->
    <link href="{{ asset('assets/front/css/dresponsive.css') }}" rel="stylesheet">

     <link href="{{ asset('assets/admin/css/sweetalert.css') }}" rel="stylesheet">

   <link href="{{ asset('assets/front/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    @yield('style')
    <link rel="stylesheet" href="{{ asset('assets/front/2/css/style.css')}}">
    <style>
        .user-dashboard-body {
            background: #F7F7F7;
            font-size: 12px;
            font-family: 'Open Sans', "Helvetica Neue", Helvetica, Arial, sans-serif;
            color: #707478;
            padding: 30px 30px 10px 30px;
            min-height: 500px;
            margin-top: 30px;
            margin-bottom: 30px;
            border: 0.05px solid rgba(204,204,204, 0.2);
        }
        .slicknav_menu .slicknav_icon {
            margin: 3px 5px!important;
        }
        .slicknav_menu .slicknav_btn {
            margin: 10px 15px 19px!important;
        }
        .slicknav_menu {
            padding: 0px!important;
        }
        .slicknav_menu .slicknav_btn {
            margin: 15px 15px 12px 0px!important;
        }
        .logo img {
            max-height: 100px;
            max-width: 220px;
        }
        .copyright-text a{
            color: #fff !important;
        }
    </style>
</head>

<body  data-spy="scroll">
<!-- Start Pre-Loader-->
<div id="preloader">
    <div data-loader="circle-side"></div>

</div>
<!-- End Preload -->
    <!--main menu start-->
    <nav class="main-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo/logo.png') }}"></a>
                    </div>
                </div>
                <div class="col-md-10 text-right">
                    
                    <ul id="header-menu" class="header-navigation">

                        <li>
                            <a href="{!! route('user-dashboard') !!}" class="nav-link ">
                                <span class="title">Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">Investment <i class="fa fa-caret-down"></i></a>
                            <ul class="mega-menu mega-menu1 mega-menu2 menu-postion">

                                    <li class="mega-list mega-list1">
                                        <a href="{!! route('investment-new') !!}" class="nav-link ">
                                            <span class="title">New Investment</span>
                                        </a>
                                    
                                        <a href="{!! route('investment-history') !!}" class="nav-link ">
                                            <span class="title">Investment History</span>
                                        </a>
                                   
                                        <a href="{!! route('user-repeat-history') !!}" class="nav-link ">
                                            <span class="title">Repeat History</span>
                                        </a>
                                    </li>
                            </ul>
                        </li>

                        <li><a href="#">transaction <i class="fa fa-caret-down"></i></a>
                            <ul class="mega-menu mega-menu1 mega-menu2 menu-postion-2">
                                    
                                    <li class="mega-list mega-list1">
                               
                                    <a href="{!! route('withdraw-request') !!}" class="nav-link ">
                                        <span class="title"> Withdraw Fund</span>
                                    </a>

                                    <a href="{!! route('withdraw-log') !!}" class="nav-link ">
                                        <span class="title"> Withdraw History</span>
                                    </a>

                                    <a href="{!! route('deposit-fund') !!}" class="nav-link ">
                                        <span class="title">Deposit Fund</span>
                                    </a>
                             
                                    <a href="{!! route('deposit-history') !!}" class="nav-link ">
                                        <span class="title">Deposit History</span>
                                    </a>
                               
                                    <a href="{!! route('user-activity') !!}" class="nav-link ">
                                        <span class="title">Transaction Log</span>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        @if(Auth::check())
                            <li><a href="#">Hi. {{ Auth::user()->name }} <i class="fa fa-caret-down"></i></a>
                                <ul class="mega-menu mega-menu1 mega-menu2 menu-postion-3">
                                    <li class="mega-list mega-list1">
                                        <a href="{!! route('edit-profile') !!}">Edit Profile </a>
                                        <a href="{!! route('change-password') !!}">Change Password </a>
                                        <a href="{!! route('support-all') !!}" class="nav-link nav-toggle">
                                            <span class="title">Get Support</span></a>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"></i> Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li><a href="#">Account <i class="fa fa-caret-down"></i></a>
                                <ul class="mega-menu mega-menu1 mega-menu2 .menu-postion-3">
                                     <li class="mega-list mega-list1">
                                        <a href="{{ route('login') }}">Login</a>
                                        <a href="{{ route('register') }}">Register</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav><!--main menu end-->

<div class="clearfix"></div>

         <div class="main-content">
             @yield('content')
         </div>
 
<!-- Online Section End -->

<div class="clearfix"></div>

<!--footer area start-->
<footer id="contact" class="footer-area">
        <div class="container">
                      <div class="row">
                <div class="col-md-2 col-sm-12 wow fadeInLeft" data-wow-duration="3s">
                    <p class="copyright-text">
                       
                    </p>
                </div>
                <div class="col-md-8 col-sm-9 wow bounceInDown" data-wow-duration="3s">
                    <p class="copyright-text">
                        {!! $basic->copy_text !!}
                    </p>
                </div>
                <div class="col-md-2 col-sm-3 wow fadeInRight" data-wow-duration="3s">
                    
                </div>
            </div>
        </div>
    </div>
    <div id="back-to-top" class="scroll-top back-to-top" data-original-title="" title="" >
        <i class="fa fa-angle-up"></i>
    </div>
</footer>

<style type="text/css">
    li.export-main {
        visibility: hidden;
    }
</style>

 <!--Google Map APi Key-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHzPSV2jshbjI8fqnC_C4L08ffnj5EN3A"></script>
<!--jquery script load-->
<script src="{{ asset('assets/front/js/jquery.js') }}"></script>

<script src="{{ asset('assets/front/2/js/modernizr.js')}}"></script>

<script src="{{ asset('assets/admin/js/sweetalert.min.js') }}"></script>

<script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/front/js/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('assets/front/js/dataTables.bootstrap.min.js') }}"></script>

<!-- Gmap Load Here -->
<script src="{{ asset('assets/front/js/gmaps.js') }}"></script>
<!-- Map Js File Load -->
<script src="{{ asset('assets/front/js/map-script.php?color='.$basic->color) }}"></script>
<!-- Highlight script load-->
<script src="{{ asset('assets/front/js/highlight.min.js') }}"></script>
<!--Jquery Ui Slider script load-->
<script src="{{ asset('assets/front/js/jquery-ui-slider.min.js') }}"></script>
<!--Circleful Js File Load-->
<script src="{{ asset('assets/front/js/jquery.circliful.js') }}"></script>
<!--CounterUp script load-->
<script src="{{ asset('assets/front/js/jquery.counterup.min.js') }}"></script>
<!-- Ripples  script load-->
<script src="{{ asset('assets/front/js/jquery.ripples-min.js') }}"></script>
<!--Slick Nav Js File Load-->
<script src="{{ asset('assets/front/js/jquery.slicknav.min.js') }}"></script>
<!--Lightcase Js File Load-->
<script src="{{ asset('assets/front/js/lightcase.js') }}"></script>
<!--particle Js File Load-->

<script src="{{ asset('assets/front/js/particles.min.js') }}"></script>
<!--particle custom Js File Load-->
<script src="{{ asset('assets/front/js/particles-custom.js') }}"></script>
<!--RainDrops script load-->
<script src="{{ asset('assets/front/js/raindrops.js') }}"></script>
<!--Easing script load-->
<script src="{{ asset('assets/front/js/easing-min.js') }}"></script>
<!--Slick Slider Js File Load-->
<script src="{{ asset('assets/front/js/slick.min.js') }}"></script>
<!--Swiper script load-->
<script src="{{ asset('assets/front/js/swiper.min.js') }}"></script>
<!--WayPoints script load-->
<script src="{{ asset('assets/front/js/waypoints.min.js') }}"></script>


<!--Main js file load-->
<script src="{{ asset('assets/front/js/main.js') }}"></script>

<script src="{{ asset('assets/front/2/js/main.js') }}"></script>
@yield('script')
<!--swal alert message-->
@if (session('success'))
   <script type="text/javascript">
       $(document).ready(function(){
           swal("Success!", "{{ session('success') }}", "success");
       });
   </script>
@endif
@if (session('alert'))
   <script type="text/javascript">
       $(document).ready(function(){
           swal("Sorry!", "{{ session('alert') }}", "error");
       });
   </script>
@endif
@if (session('error'))
   <script type="text/javascript">
       $(document).ready(function(){
           swal("Sorry!", "{{ session('error') }}", "error");
       });
   </script>
@endif

@if (session('message'))
   <script type="text/javascript">
       $(document).ready(function(){
           swal("{{ session('message') }}");
       });
   </script>
@endif
<script>
       $(document).ready(function() {
           $('#sample_1').DataTable()
       });
   </script>
   <script>
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5f9d52fa16ea1756a6df1823/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
   </script>
<!--end swal alert message-->
</body>
</html>



