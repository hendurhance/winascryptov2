@extends('layouts.newfrontend')

@section('content')

    <!--header section start-->
    <section class="breadcrumb-section" style="background-image: url('{{ asset('assets/images') }}/{{ $basic->breadcrumb }}')">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <!-- breadcrumb Section Start -->
            <div class="breadcrumb-content">
               <h5>{{ $page_title}}</h5>
            </div>
            <!-- Breadcrumb section End -->
          </div>
        </div>
      </div>
    </section>
    <!--Header section end-->

    <!--login section start-->
    <div class="login-section section-padding login-bg">
        <div class="container">
                                     
                    <div class="login-admin login-admin1">
                         <div class="login-header text-center">
                            <h6>Register Form</h6>
                         </div>
                        <div class="login-form">     
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {!!  $error !!}
                                    </div>
                                @endforeach
                            @endif
                            <form method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        @if($reference == '0')
                                            <input type="text" name="under_reference" id="under_reference" value="@if($reference){{ $reference }}@endif" placeholder="Reference ID"/>
                                        @else
                                            <input type="hidden" name="under_reference" id="under_reference" value="@if($reference){{ $reference }}@endif" placeholder="Reference ID"/>
                                        @endif
                                    </div>
                                    <div class="col-md-{{$reference != '0' ? '12' : '6'}}">
                                         <input type="text"  name="username" id="username" required placeholder="Enter your Username"/>
                                    </div>
                                </div>  
                                <hr>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text"  name="name" id="name" required placeholder="Enter your Name"/>           
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"  name="email" id="email" required placeholder="Enter your Email"/>     
                                    </div>
                                       <div class="col-md-6">
                                    <input type="text"  name="phone" id="phone" required placeholder="Enter your Phone Number"/>
                                </div>
                                </div>
                                <hr>
                                <br>
                              <div class="row">
                                    <div class="col-md-6">
                                        <input type="password"  name="password" id="password" required placeholder="Enter your Password"/>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="password"  name="password_confirmation" id="password_confirmation" required placeholder="Confirm your Password"/>
                                    </div>
                               </div>                              
                                
                                @if($basic->google_recap == 1)
                                    <div class="form-group">
                                        <div class="cols-sm-10">
                                            {!! app('captcha')->display() !!}
                                        </div>
                                    </div>
                                @endif
                                 <div class="row">
                                     <div class="col-md-12">
                                         <input value="Register" type="submit">
                                     </div>
                                 </div>
                                    

                            </form>
                        </div>     
                                <div class="text-center" style="text-transform: uppercase;">
                                    <br><br>
                                      <a href="{{ route('password.request') }}">Forgot Password</a> | <a href="{{ route('login') }}">Login</a>
                                    <br><br>
                                </div>
                        </div>
                    </div>
        </div>
    </div>
    <!--login section end-->

@endsection
