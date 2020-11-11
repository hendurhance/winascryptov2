@extends('layouts.dashboard')
@section('style')
@endsection
@section('content')



    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <strong><i class="fa fa-line-chart bold uppercase"></i> Main Statistics</strong>
                            </div>
                            <div class="tools">
                               <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="overflow: hidden">
                            <div class="col-md-3">
                                <div class="dashboard-stat green">
                                    <div class="visual">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            {{ $basic->symbol }} <span data-counter="counterup" data-value="{{ round($user_balance, $basic->deci) }}">0</span>
                                        </div>
                                        <div class="desc bold uppercase"> Total User Balance</div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('repeat-history') }}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat purple">
                                        <div class="visual">
                                            <i class="fa fa-recycle"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                {{ $basic->symbol }} <span data-counter="counterup" data-value="{{ $total_repeat }}">0</span>
                                            </div>
                                            <div class="desc  bold uppercase "> Total Repeat </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('user-deposit-history') }}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                {{ $basic->symbol }}  <span data-counter="counterup" data-value="{{ $total_deposit }}">0</span>
                                            </div>
                                            <div class="desc  bold uppercase"> Total Deposit </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ url('admin/withdraw-request-all') }}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-money"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                {{ $basic->symbol }} <span data-counter="counterup" data-value="{{ $total_withdraw }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Withdraw </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box purple">
                        <div class="portlet-title">
                            <div class="caption bold uppercase">
                                <strong><i class="fa fa-handshake-o"></i> Support Statistics</strong>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="overflow: hidden">
                            <a href="{{ url('admin/admin-support') }}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-envelope-open"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{ $total_ticket }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase small14"> Total Open Support Ticket</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ url('admin/admin-support-pending') }}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat yellow">
                                        <div class="visual">
                                            <i class="fa fa-spinner"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{ $total_pending_ticket }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Pending Support Ticket </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ url('admin/admin-support') }}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat green">
                                        <div class="visual">
                                            <i class="fa fa-reply-all"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{ $total_answer }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase small13"> Total Answer Support Ticket </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ url('admin/admin-support') }}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-times"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{ $total_close }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase small13"> Total Close Support Ticket  </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption bold uppercase">
                                <strong><i class="fa fa-users"></i> User Statistics</strong>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="overflow: hidden">
                            <a href="{{ url('admin/manage-user') }}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{ $total_user }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total User </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ url('admin/show-block-user') }}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-times"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{ $block_user }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Block User </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ url('admin/email-unverified-user') }}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-envelope-open"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{ $email_verify }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Email Unverified  </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ url('admin/phone-unverified-user') }}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{ $phone_verify }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Phone Unverified  </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption bold uppercase">
                                <strong><i class="fa fa-cloud-download"></i> Deposit Statistics</strong>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="overflow: hidden">
                            <a href="{{--{{ url('admin/deposit-method') }}--}}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-sort-numeric-asc"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{ $deposit_method }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Deposit Method </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{--{{ url('admin/user-deposit-history') }}--}}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-sort-numeric-asc"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{ $deposit_number }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Number of Deposits </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{--{{ url('admin/user-deposit-history') }}--}}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-cloud-download"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                {{ $basic->symbol }} <span data-counter="counterup" data-value="{{ $total_deposit }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Deposit </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{--{{ url('admin/pending-deposit') }}--}}">
                                <div class="col-md-3">
                                    <div class="dashboard-stat yellow">
                                        <div class="visual">
                                            <i class="fa fa-spinner"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{ $deposit_pending }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Deposit Pending</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption bold uppercase">
                                <strong><i class="fa fa-th"></i> Investment Plan Statistics</strong>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="overflow: hidden">
                            <a href="{{--{{ url('admin/plan-show') }}--}}">
                                <div class="col-md-4">
                                    <div class="dashboard-stat purple">
                                        <div class="visual">
                                            <i class="fa fa-list"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{ $total_plan }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Plan </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{--{{ url('admin/plan-show') }}--}}">
                                <div class="col-md-4">
                                    <div class="dashboard-stat blue">
                                        <div class="visual">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{ $active_plan }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Active Plan </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{--{{ url('admin/plan-show') }}--}}">
                                <div class="col-md-4">
                                    <div class="dashboard-stat red">
                                        <div class="visual">
                                            <i class="fa fa-times"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{ $deactive_plan }}">0</span>
                                            </div>
                                            <div class="desc bold uppercase"> Total Deactivate Plan </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption bold uppercase">
                                <strong><i class="fa fa-cloud-upload"></i> Withdraw Statistics</strong>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="overflow: hidden">

                            <div class="row">
                                <a href="{{--{{ url('admin/withdraw-show') }}--}}">
                                    <div class="col-md-4">
                                        <div class="dashboard-stat purple">
                                            <div class="visual">
                                                <i class="fa fa-sort-alpha-asc"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="{{ $withdraw_method }}">0</span>
                                                </div>
                                                <div class="desc bold uppercase"> Withdraw Method </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{--{{ url('admin/withdraw-request-all') }}--}}">
                                    <div class="col-md-4">
                                        <div class="dashboard-stat blue">
                                            <div class="visual">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    {{ $basic->symbol }} <span data-counter="counterup" data-value="{{ $total_withdraw }}">0</span>
                                                </div>
                                                <div class="desc bold uppercase"> Withdraw Amount </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{--{{ url('admin/withdraw-request-all') }}--}}">
                                    <div class="col-md-4">
                                        <div class="dashboard-stat red">
                                            <div class="visual">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    {{ $basic->symbol  }} <span data-counter="counterup" data-value="{{ $withdraw_charge }}">0</span>
                                                </div>
                                                <div class="desc bold uppercase"> Withdraw Charge </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <br>
                            <div class="row">
                                <a href="{{--{{ url('admin/withdraw-request-all') }}--}}">
                                    <div class="col-md-3">
                                        <div class="dashboard-stat purple">
                                            <div class="visual">
                                                <i class="fa fa-sort-asc"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="{{ $withdraw_number }}">0</span>
                                                </div>
                                                <div class="desc bold uppercase"> Number of Withdraw </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a href="{{--{{ url('admin/withdraw-confirm-show') }}--}}">

                                    <div class="col-md-3">
                                        <div class="dashboard-stat blue">
                                            <div class="visual">
                                                <i class="fa fa-check-square-o"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="{{ $withdraw_success }}">0</span>
                                                </div>
                                                <div class="desc bold uppercase"> Success Withdraw </div>
                                            </div>
                                        </div>
                                    </div></a>
                                <a href="{{--{{ url('admin/withdraw-pending') }}--}}">
                                    <div class="col-md-3">
                                        <div class="dashboard-stat yellow">
                                            <div class="visual">
                                                <i class="fa fa-spinner"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="{{ $withdraw_pending }}">0</span>
                                                </div>
                                                <div class="desc bold uppercase"> Pending Withdraw </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{--{{ url('admin/withdraw-refund-show') }}--}}">
                                    <div class="col-md-3">
                                        <div class="dashboard-stat red">
                                            <div class="visual">
                                                <i class="fa fa-times"></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup" data-value="{{ $withdraw_refund }}">0</span>
                                                </div>
                                                <div class="desc bold uppercase"> Refunded Withdraw </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <strong><i class="fa fa-external-link bold uppercase"></i> Corn URL:</strong>
                            </div>
                            <div class="tools">
                               <a href="javascript:;" class="collapse"> </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="overflow: hidden">
                            <div class="col-md-8 col-md-offset-2">
<div class="input-group">
                                                        <div class="input-icon">
                                                            <i class="fa fa-external-link"></i>
                                                            <input id="rurl" class="form-control" type="text" name="password" placeholder="text" value="wget {{route('repeat-generate')}}" readonly=""> </div>
                                                        <span class="input-group-btn">
                                                            <button id="cbtn" class="btn btn-success" type="button">
                                                                <i class="fa fa-arrow-left fa-fw"></i> Copy</button>
                                                        </span>
                                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
 document.getElementById("cbtn").onclick = function()
 {
   document.getElementById('rurl').select();
   document.execCommand('copy');
 }
</script>

@endsection
@section('scripts')

    <script src="{{ asset('assets/admin/js/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/jquery.counterup.min.js') }}" type="text/javascript"></script>


@endsection