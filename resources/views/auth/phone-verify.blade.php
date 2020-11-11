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
                    <div class="main-login main-center">
                        <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="Logo Image Will Be Here"></a>
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

                        <form class="form-horizontal" method="POST" action="{{ route('phone-verify-submit') }}">
                            {{ csrf_field() }}

                            <h4 class="block">Phone Verification Code:</h4>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key fa-2x"></i></span>
                                <input name="code" id="code" class="form-control input-lg" placeholder="Verification Code" type="text" required="">
                            </div>
                            <br>
                            <button class="btn btn-success btn-lg btn-block" type="submit" id="btn-login">Verify Now</button>
                        </form>

                        <form style="margin-top: 10px;" class="form-horizontal" method="POST" action="{{ route('resend-phone-verify-submit') }}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-sm btn-block btn-danger">
                                        Resend Phone Verification
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('change-phone') }}" class="btn btn-block btn-sm btn-success">
                                        Change phone Number
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--login section end-->

@endsection
