@extends('layouts.user-frontend.user-dashboard')
@section('style')

<style>
    .input-text-box{
    border: 1px solid black;
    }
</style>

@endsection
@section('content')
@include('layouts.breadcam')
<div class="content_padding">
    <div class="container user-dashboard-body">
            <div class="row">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="page_title">{!! $page_title  !!} </h3>
                        <hr>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="col-sm-12 text-center">
                            <div class="panel panel-default panel-pricing">
                                <div class="panel-heading">
                                    <h3 style="font-size: 28px;"><b style=" color:#ffffff">{{ $method->name }}</b></h3>
                                </div>
                                <div style="font-size: 18px;padding: 18px;" class="panel-body text-center">
                                    <img class="" style="width: 35%;border-radius: 5px" src="{{ asset('assets/images') }}/{{ $method->image }}" alt="">
                                </div>
                                <ul style='font-size: 15px;' class="list-group text-center bold">
                                    <li class="list-group-item">Limit - ( {!! $method->withdraw_min !!} to {{ $method->withdraw_max }} ) {{ $basic->currency }} </li>
                                    <li class="list-group-item"> Fix Charge - {{ $method->fix }} {{ $basic->currency }}</li>
                                    <li class="list-group-item"> Percentage - {{ $method->percent }}<i class="fa fa-percent"></i></li>
                                    <li class="list-group-item">Duration - {!! $method->duration !!} Days </li>
                                </ul>
                                <div class="panel-footer" style="overflow: hidden">
                                    <div class="col-sm-12">
                                        <a href="{{ route('withdraw-request') }}" class="btn bold uppercase btn-primary btn-block btn-icon icon-left"><i class="fa fa-arrow-left"></i> Another Method</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                            <!-- panel head -->
                            <div class="panel-heading">
                                <div class="panel-title"><i class="fa fa-money"></i> <strong>{{ $page_title }}</strong></div>
                            </div>
                            <!-- panel body -->
                            <div class="panel-body">
                                <div class="text-center">
                                    <h3 class="bold uppercase">Current Balance : <strong>{{ $balance->balance }} - {{ $basic->currency }}</strong></h3>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="form-group">
                                        <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 bold uppercase text-right control-label">Request Amount : </label>

                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="text" value="{{ $withdraw->amount }}" readonly name="amount" id="amount" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                                <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group">
                                        <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 text-right bold uppercase control-label">Withdrawal Charge : </label>

                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="text" value="{{ round($withdraw->charge,$basic->deci )}}" readonly name="charge" id="charge" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                                <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="form-group">
                                        <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 bold uppercase text-right control-label">Total Amount : </label>

                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="text" value="{{ $withdraw->net_amount }}" readonly name="charge" id="charge" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                                <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group">
                                        <label style="margin-top: 5px;font-size: 14px;" class="col-sm-4 col-sm-offset-1 bold uppercase text-right control-label">Available Balance : </label>

                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="text" value="{{ $balance->balance - $withdraw->net_amount }}" readonly name="charge" id="charge" class="form-control bold" placeholder="Enter Deposit Amount" required>
                                                <span class="input-group-addon red">&nbsp;<strong> {{ $basic->currency }} </strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <div class="panel panel-default panel-shadow" data-collapsed="0"><!-- to apply shadow add class "panel-shadow" -->

                        <!-- panel head -->
                        <div class="panel-heading">
                            <div class="panel-title"><i class="fa fa-send"></i> <strong>Payment Send Details</strong></div>
                        </div>
                        <!-- panel body -->
                        <div class="panel-body">
                            <div class="col-md-12">

                                {!! Form::open(['route'=>'withdraw-submit']) !!}
                                <input type="hidden" name="withdraw_id" value="{{ $withdraw->id }}">
                                <div class="row">
                                    <div class="form-group">
                                        <label style="margin-top: 5px;font-size: 14px;" class="col-sm-2 bold uppercase text-right  control-label">Sending Details : </label>

                                        <div class="col-sm-8">

                                                        <textarea name="send_details" id="" rows="4"
                                                                  class="form-control bold input-lg" placeholder="Sending Details" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group">
                                        <label style="margin-top: 5px;font-size: 14px;" class="col-sm-2 bold uppercase text-right control-label">Message  : </label>

                                        <div class="col-sm-8">

                                                        <textarea name="message" id="" rows="3"
                                                                  class="form-control bold input-lg" placeholder="Message ( If Any )"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group">

                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button class="btn btn-primary btn-icon bold uppercase icon-left btn-block"><i class="fa fa-send"></i> Submit Withdraw</button>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div><!---ROW-->
    </div>
</div>



@endsection
@section('script')

@endsection

