@extends('layouts.newfrontend')

@section('content')

    <!--header section start-->
    <section class="breadcrumb-section" style="background-image: url('{{ asset('assets/images') }}/{{ $basic->breadcrumb }}">
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
<section  class="circle-section section-padding section-background">
    <div class="container">
        <div class="row">
  
            <div class="col-md-6 col-md-offset-3">
                <div class="login-admin login-admin1">
                    <div class="login-header text-center">
                      <h6>Login Form</h6>
                    </div>
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {!!  $error !!}
                                </div>
                            @endforeach
                        @endif
                        
                        @if (session()->has('message'))
                            <div class="alert alert-{{ session()->get('type') }} alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        
                        @if (session()->has('status'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session()->get('status') }}
                            </div>
                        @endif
                       <div class="login-form"> 
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <input type="text" name="username" id="username" required placeholder="Enter your User Name"/>     
                            <input type="password" name="password" id="password" required placeholder="Enter your Password"/>

                           <input value="Login" type="submit">

                             <div class="form-group">
                                <div class="cols-sm-10 cols-sm-offset-2">
                                    <div class="col-sm-12 text-center">
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>

@endsection
