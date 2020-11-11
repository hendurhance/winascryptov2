@extends('layouts.fontEnd')
@section('content')

    <!--header section start-->
    <section style="background-image: url('{{ asset('assets/images') }}/{{ $basic->breadcrumb }}')" class="breadcrumb-section contact-bg section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>{{ $page_title}}</h1>
                </div>
            </div>
        </div>
    </section><!--Header section end-->


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

                        <form class="form-horizontal" method="POST" action="{{ route('phone-change-submit') }}">
                            {{ csrf_field() }}

                            <h4 class="block">Old Phone Number:</h4>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone fa-2x"></i></span>
                                <input name="old_phone" id="phone" readonly class="form-control input-lg" value="{{ Auth::user()->phone }}" placeholder="Change Verification phone" type="text">
                            </div>
                            <br>
                            <h4 class="block">New Phone Number:</h4>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone fa-2x"></i></span>
                                <input name="phone" id="phone" class="form-control input-lg" placeholder="New Verification phone" type="text" required="">
                            </div>
                            <br>
                            <button class="btn btn-success btn-lg btn-block" type="submit" id="btn-login">Update & Verify Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--login section end-->

@endsection
