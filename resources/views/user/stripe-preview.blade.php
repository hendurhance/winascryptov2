@extends('layouts.user-frontend.user-dashboard')
@section('style')
    <style>
        .credit-card-box .panel-title {
            display: inline;
            font-weight: bold;
        }
        .credit-card-box .form-control.error {
            border-color: red;
            outline: 0;
            box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(255,0,0,0.6);
        }
        .credit-card-box label.error {
            font-weight: bold;
            color: red;
            padding: 2px 8px;
            margin-top: 2px;
        }
        .credit-card-box .payment-errors {
            font-weight: bold;
            color: red;
            padding: 2px 8px;
            margin-top: 2px;
        }
        .credit-card-box label {
            display: block;
        }
        /* The old "center div vertically" hack */
        .credit-card-box .display-table {

        }
        .credit-card-box .display-tr {
            display: table-row;
        }
        .credit-card-box .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 60%;
        }
        /* Just looks nicer */
        .credit-card-box .panel-heading img {
            min-width: 180px;
        }
    </style>
@endsection
@section('content')
@include('layouts.breadcam')
<div class="content_padding">
    <div class="container user-dashboard-body">
    <div class="row">
        <div class="col-md-12">
            <div class="panel ">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8 col-sm-12 col-md-offset-2">
                            <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                                <!-- panel head -->
                                <div class="panel-heading">
                                    <div class="panel-title"><i class="fa fa-money"></i> <strong>{{ $page_title }}</strong></div>
                                </div>
                                <!-- panel body -->
                                <div class="panel-body">

                                    <div class="panel panel-default credit-card-box" style="margin:32px 0;">
                                        <div class="panel-heading display-table" >
                                            <div class="row display-tr" >
                                                <h3 class="panel-title display-td" style="padding-left: 10px">Payment Details</h3>
                                                <div class="display-td" >
                                                    <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">

                                            <form role="form" method="POST" action="{{ route('stripe-submit') }}">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="amount" value="{{ $amount }}">
                                                <input type="hidden" name="custom" value="{{ $custom }}">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <div class="form-group">
                                                            <label for="cardNumber">CARD NUMBER</label>
                                                            <div class="input-group">
                                                                <input
                                                                        type="tel"
                                                                        class="form-control input-lg"
                                                                        name="cardNumber"
                                                                        placeholder="Valid Card Number"
                                                                        autocomplete="off"
                                                                        required autofocus
                                                                />
                                                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row">
                                                    <div class="col-xs-4 col-md-4">
                                                        <div class="form-group">
                                                            <label for="cardExpiry"><span class="hidden-xs">EXP MONTH</span></label>
                                                            <input
                                                                    type="tel"
                                                                    class="form-control input-lg"
                                                                    name="cardExpiryMonth"
                                                                    placeholder="MM"
                                                                    autocomplete="off"
                                                                    required
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4 col-md-4">
                                                        <div class="form-group">
                                                            <label for="cardExpiry"><span class="hidden-xs">EXP YEAR</span></label>
                                                            <input
                                                                    type="tel"
                                                                    class="form-control input-lg"
                                                                    name="cardExpiryYear"
                                                                    placeholder="YYYY"
                                                                    autocomplete="off"
                                                                    required
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-4 col-md-4 pull-right">
                                                        <div class="form-group">
                                                            <label for="cardCVC">CV CODE</label>
                                                            <input
                                                                    type="tel"
                                                                    class="form-control input-lg"
                                                                    name="cardCVC"
                                                                    placeholder="CVC"
                                                                    autocomplete="off"
                                                                    required
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <button class="subscribe btn btn-success btn-lg btn-block" type="submit">Payment Now</button>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- ROW-->
  </div>
</div><!-- ROW-->
@endsection
