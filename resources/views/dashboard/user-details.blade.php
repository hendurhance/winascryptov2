@extends('layouts.dashboard')
@section('style')

    <link href="{{ asset('assets/admin/css/bootstrap-toggle.min.css') }}" rel="stylesheet">


@endsection
@section('content')

    @if($user != null)

        <div class="row">
            <div class="col-md-12">


                <div class="portlet blue box">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <strong>User Details</strong>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body" style="overflow:hidden;">

                        <div class="col-md-3">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption uppercase bold">
                                        <i class="fa fa-user"></i> PROFILE </div>
                                </div>
                                <div class="portlet-body text-center" style="overflow:hidden;">
                                    <img src="@if($user->image == 'user-default.png') {{ asset('assets/images/user-default.png') }} @else {{ asset('assets/images') }}/{{ $user->image }}@endif" class="img-responsive propic" alt="Profile Pic">

                                    <hr><h4 class="bold">User Name : {{ $user->username}}</h4>
                                    <h4 class="bold">Name : {{ $user->name }}</h4>
                                    <h4 class="bold">BALANCE : {{ $user->balance }} {{ $basic->currency }}</h4>
                                    <hr>
                                    @if($user->login_time != null)
                                        <p>
                                            <strong>Last Login : {{ \Carbon\Carbon::parse($user->login_time)->diffForHumans() }}</strong> <br>
                                        </p>
                                    <hr>
                                    @endif
                                    @if($last_login != null)
                                    <p>
                                        <strong>Last Login From</strong> <br> {{ $last_login->user_ip }} -  {{ $last_login->location }} <br> Using {{ $last_login->details }} <br>
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="portlet box purple">
                                        <div class="portlet-title">
                                            <div class="caption uppercase bold">
                                                <i class="fa fa-desktop"></i> Details </div>
                                            <div class="tools"> </div>
                                        </div>
                                        <div class="portlet-body">

                                            <div class="row">


                                                <!-- START -->
                                                <a href="{{ route('user-repeat-all',$user->username) }}">
                                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
                                                        <div class="dashboard-stat blue">
                                                            <div class="visual">
                                                                <i class="fa fa-recycle"></i>
                                                            </div>
                                                            <div class="details">
                                                                <div class="number">
                                                                    <span data-counter="counterup" data-value="{{ $total_repeat }}">0</span>
                                                                </div>
                                                                <div class="desc uppercase bold"> REPEAT </div>
                                                            </div>
                                                            <div class="more">
                                                                <div class="desc uppercase bold text-center">
                                                                    {{ $basic->symbol }}
                                                                    <span data-counter="counterup" data-value="{{ $total_repeat_amount }}">0</span> REPEAT
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <!-- END -->

                                                <a href="{{ route('user-deposit-all',$user->username) }}">
                                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
                                                        <div class="dashboard-stat green">
                                                            <div class="visual">
                                                                <i class="fa fa-cloud-download"></i>
                                                            </div>
                                                            <div class="details">
                                                                <div class="number">
                                                                    <span data-counter="counterup" data-value="{{ $total_deposit }}">0</span>
                                                                </div>
                                                                <div class="desc uppercase bold "> DEPOSIT </div>
                                                            </div>
                                                            <div class="more">
                                                                <div class="desc uppercase bold text-center">
                                                                    {{ $basic->symbol }}
                                                                    <span data-counter="counterup" data-value="{{ $total_deposit_amount }}">0</span> DEPOSIT
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <!-- END -->

                                                <a href="{{ route('user-withdraw-all',$user->username) }}">
                                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
                                                        <div class="dashboard-stat red">
                                                            <div class="visual">
                                                                <i class="fa fa-cloud-upload"></i>
                                                            </div>
                                                            <div class="details">
                                                                <div class="number">
                                                                    <span data-counter="counterup" data-value="{{ $total_withdraw }}">0</span>
                                                                </div>
                                                                <div class="desc uppercase  bold "> WITHDRAW </div>
                                                            </div>
                                                            <div class="more">
                                                                <div class="desc uppercase bold text-center">
                                                                    {{ $basic->symbol }}
                                                                    <span data-counter="counterup" data-value="{{ $total_withdraw_amount }}">0</span> WITHDRAW
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <!-- END -->

                                                <a href="{{ route('user-login-all',$user->username) }}">
                                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
                                                        <div class="dashboard-stat yellow">
                                                            <div class="visual">
                                                                <i class="fa fa-sign-in"></i>
                                                            </div>
                                                            <div class="details">
                                                                <div class="number">
                                                                    <span data-counter="counterup" data-value="{{ $total_login }}">0</span>
                                                                </div>
                                                                <div class="desc uppercase  bold "> Log In </div>
                                                            </div>
                                                            <div class="more">
                                                                <div class="desc uppercase bold text-center">
                                                                    VIEW DETAILS
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <!-- END -->

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="portlet box blue-ebonyclay">
                                        <div class="portlet-title">
                                            <div class="caption uppercase bold">
                                                <i class="fa fa-cogs"></i> Operations </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">

                                                <div class="col-md-6 uppercase">
                                                    <a href="{{ route('user-money',$user->username) }}" class="btn btn-primary btn-lg btn-block"> <i class="fa fa-money"></i> add / substruct balance  </a>
                                                </div>

                                                <div class="col-md-6 uppercase">
                                                    <a href="{{ route('user-send-mail',$user->id) }}" class="btn btn-success btn-lg btn-block"><i class="fa fa-envelope-open"></i> Send Email</a>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="portlet box green">
                                        <div class="portlet-title">
                                            <div class="caption uppercase bold">
                                                <i class="fa fa-cog"></i> Update Profile </div>
                                        </div>
                                        <div class="portlet-body">

                                            <form action="{{ route('user-details-update') }}" method="post">

                                                {!! csrf_field() !!}

                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <div class="row uppercase">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-md-12"><strong>Name</strong></label>
                                                            <div class="col-md-12">
                                                                <input class="form-control input-lg" name="name" value="{{ $user->name }}" type="text">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-md-12"><strong>Email</strong></label>
                                                            <div class="col-md-12">
                                                                <input class="form-control input-lg" name="email" value="{{ $user->email }}" type="text">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-md-12"><strong>Phone</strong></label>
                                                            <div class="col-md-12">
                                                                <input class="form-control input-lg" name="phone" value="{{ $user->phone }}" type="text">
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div><!-- row -->

                                                <br><br>
                                                <div class="row uppercase">


                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-md-12"><strong>STATUS</strong></label>
                                                            <div class="col-md-12">
                                                                <input data-toggle="toggle" {{ $user->status == 0 ? 'checked' : ''}} data-onstyle="success" data-size="large" data-offstyle="danger" data-on="Active" data-off="Blocked"  data-width="100%" type="checkbox" name="status">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-md-12"><strong>EMAIL VERIFICATION</strong></label>
                                                            <div class="col-md-12">
                                                                <input data-toggle="toggle" {{ $user->email_verify == 1 ? 'checked' : ''}} data-onstyle="success" data-size="large" data-offstyle="danger" data-on="Verified" data-off="Not Verified"  data-width="100%" type="checkbox" name="email_verify">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-md-12"><strong>PHONE VERIFICATION</strong></label>
                                                            <div class="col-md-12">
                                                                <input data-toggle="toggle" {{ $user->phone_verify == 1 ? 'checked' : ''}} data-onstyle="success" data-size="large" data-offstyle="danger" data-on="Verified" data-off="Not Verified"  data-width="100%" type="checkbox" name="phone_verify">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div><!-- row -->

                                                <br><br>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn blue btn-block btn-lg">UPDATE</button>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div><!-- col-9 -->

                    </div>
                </div>

            </div>
        </div><!-- ROW-->

    @else

        <div class="text-center">
            <h3>No User Found</h3>
        </div>
    @endif


@endsection
@section('scripts')

    <script src="{{ asset('assets/admin/js/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/jquery.counterup.min.js') }}" type="text/javascript"></script>

@endsection

