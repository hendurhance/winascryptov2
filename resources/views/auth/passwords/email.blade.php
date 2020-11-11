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


    <!--login section start-->
    <div class="login-section section-padding login-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="login-admin login-admin1">
                        <div class="login-form">
                                <div class="login-header text-center">
                                    <h6>RESET PASSWORD</h6>
                                </div> 
                            <br>
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

                            <form method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}
                                    <input type="text" name="email" id="email" required placeholder="Enter your Email"/>

                                    <input type="submit" value=" Send Password Reset Link">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--login section end-->
@endsection
